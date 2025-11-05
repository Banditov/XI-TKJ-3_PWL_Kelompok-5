document.querySelectorAll(".productColor input[type='checkbox']").forEach(checkbox => {
    checkbox.addEventListener("change", async function () {
        const card = this.closest(".stationeryProduct, .bookProduct");
        const productId = card?.dataset?.id;
        const color = this.value;

        if (!productId || !color) {
            console.error("Missing product ID or color!", { productId, color });
            return;
        }

        const name = card.querySelector(".productName");
        const stock = card.querySelector(".productStock");
        const price = card.querySelector(".productPrice");
        const img =
            card.querySelector(".productImage img") ||
            card.querySelector(".productImageHorizon img");

        if (!card.dataset.defaultSaved) {
            card.dataset.defaultName = name?.textContent || "";
            card.dataset.defaultStock = stock?.textContent.replace("Stok: ", "") || "";
            card.dataset.defaultPrice = price?.textContent.replace(/[^\d]/g, "") || "";
            card.dataset.defaultImage = img?.src || "";
            card.dataset.defaultSaved = "true";
        }

        const allBoxes = card.querySelectorAll(".productColor input[type='checkbox']");
        const checkedBoxes = Array.from(allBoxes).filter(box => box.checked);

        let displayColor = null;

        if (this.checked) {
            displayColor = color;
            card.dataset.activeColor = color;
        } else {
            if (checkedBoxes.length > 0) {
                const lastChecked = checkedBoxes[checkedBoxes.length - 1];
                displayColor = lastChecked.value;
                card.dataset.activeColor = displayColor;
            } else {
                displayColor = null;
                delete card.dataset.activeColor;
            }
        }

        console.log("Now showing:", displayColor || "Default");

        if (!displayColor) {
            if (name) name.textContent = card.dataset.defaultName;
            if (stock) stock.textContent = "Stok: " + card.dataset.defaultStock;
            if (price)
                price.textContent =
                    "Rp " + new Intl.NumberFormat("id-ID").format(card.dataset.defaultPrice);
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
            console.log("Raw PHP Response:", text);

            let data;
            try {
                data = JSON.parse(text);
            } catch (err) {
                console.error("Invalid JSON received:", text);
                return;
            }

            if (data.error) {
                alert(data.error);
                return;
            }

            if (name) name.textContent = data.product_name;
            if (stock) stock.textContent = "Stok: " + data.stock;
            if (price)
                price.textContent =
                    "Rp " + new Intl.NumberFormat("id-ID").format(data.price);
            if (img) {
                setTimeout(() => {
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
                }, 100);
            }
        } catch (err) {
            console.error("Fetch failed:", err);
        }
    });
});