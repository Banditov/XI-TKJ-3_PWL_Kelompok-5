function initProductColorEvents() {
    document.querySelectorAll(".productColor").forEach(group => {
        const checkboxes = group.querySelectorAll("input[type='checkbox']");
        if (checkboxes.length === 0) return;

        if (checkboxes.length === 1 && checkboxes[0].value.toLowerCase() === "none") {
            group.closest(".colorForm")?.remove();
            return;
        }

        const firstCheckbox = checkboxes[0];
        if (firstCheckbox && firstCheckbox.value.toLowerCase() !== "none") {
            firstCheckbox.checked = true;
            firstCheckbox.dispatchEvent(new Event("change"));
        }

        checkboxes.forEach(checkbox => {
            if (checkbox.value.toLowerCase() === "none") return;

            checkbox.addEventListener("change", async function () {
                const card = this.closest(".stationeryProduct, .bookProduct");
                if (!card) return;

                const productId = card.dataset?.id;
                const color = this.value;
                if (!productId || !color) return;

                const name = card.querySelector(".productName");
                const stock = card.querySelector(".productStock");
                const price = card.querySelector(".productPrice");
                const img = card.querySelector(".productImage img") ||
                            card.querySelector(".productImageHorizon img");

                if (!card.dataset.defaultSaved) {
                    card.dataset.defaultName = name?.textContent || "";
                    card.dataset.defaultStock = stock?.textContent.replace("Stok: ", "") || "";
                    card.dataset.defaultPrice = price?.textContent.replace(/[^\d]/g, "") || "";
                    card.dataset.defaultImage = img?.src || "";
                    card.dataset.defaultSaved = "true";
                }

                const checkedBoxes = Array.from(checkboxes).filter(box => box.checked && box.value.toLowerCase() !== "none");
                let displayColor = null;

                if (this.checked) {
                    displayColor = color;
                    card.dataset.activeColor = color;
                } else if (checkedBoxes.length > 0) {
                    displayColor = checkedBoxes[checkedBoxes.length - 1].value;
                    card.dataset.activeColor = displayColor;
                } else {
                    displayColor = null;
                    delete card.dataset.activeColor;
                }

                if (!displayColor) {
                    if (name) name.textContent = card.dataset.defaultName;
                    if (stock) stock.textContent = "Stok: " + card.dataset.defaultStock;
                    if (price)
                        price.textContent = "Rp " + new Intl.NumberFormat("id-ID").format(card.dataset.defaultPrice);
                    if (img) img.src = card.dataset.defaultImage;
                    return;
                }

                try {
                    const response = await fetch("/back-end/actions/products/update-product-colours.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `product_id=${encodeURIComponent(productId)}&color=${encodeURIComponent(displayColor)}`
                    });

                    const text = await response.text();
                    let data;
                    try {
                        data = JSON.parse(text);
                    } catch {
                        console.error("Invalid JSON:", text);
                        return;
                    }

                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    if (name) name.textContent = data.product_name;
                    if (stock) stock.textContent = "Stok: " + data.stock;
                    if (price)
                        price.textContent = "Rp " + new Intl.NumberFormat("id-ID").format(data.price);

                    if (img) {
                        img.style.transition = "opacity 0.2s ease";
                        img.style.opacity = "0";
                        setTimeout(() => {
                            const newSrc = "/back-end/database/images/" + data.image + ".png";
                            const tmpImg = new Image();
                            tmpImg.onload = () => {
                                img.src = newSrc;
                                void img.offsetWidth;
                                img.style.opacity = "1";
                            };
                            tmpImg.src = newSrc;
                        }, 200);
                    }
                } catch (err) {
                    console.error("Fetch failed:", err);
                }
            });
        });
    });
}

initProductColorEvents();