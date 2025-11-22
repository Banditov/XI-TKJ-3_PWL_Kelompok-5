function initProductColorEvents() {
    document.querySelectorAll(".productColor").forEach(group => {
        const checkboxes = group.querySelectorAll("input[type='checkbox']");
        if (checkboxes.length === 0) return;

        if (checkboxes.length === 1 && checkboxes[0].value.toLowerCase() === "none") {
            group.closest(".colorForm")?.remove();
            return;
        }

        const card = group.closest(".stationeryProduct, .bookProduct");
        if (!card) return;

        const firstValidColor = Array.from(checkboxes).find(cb => cb.value.toLowerCase() !== "none");
        const defaultColor = firstValidColor ? firstValidColor.value : "";

        if (!card.dataset.displayHistory) {
            const initiallyChecked = Array.from(checkboxes).filter(cb => cb.checked && cb.value.toLowerCase() !== "none");
            let initialColor = defaultColor;

            if (initiallyChecked.length === 0 && defaultColor) {
                const defaultCheckbox = group.querySelector(`input[value="${defaultColor}"]`);
                if (defaultCheckbox) {
                    defaultCheckbox.checked = true;
                }
            } else if (initiallyChecked.length > 0) {
                initialColor = initiallyChecked[initiallyChecked.length - 1].value;
            }

            card.dataset.displayHistory = JSON.stringify([initialColor]);
            card.dataset.currentDisplay = initialColor;
            card.dataset.defaultColor = defaultColor;
        }

        if (!card.dataset.defaultSaved) {
            const name = card.querySelector(".productName");
            const stock = card.querySelector(".productStock");
            const price = card.querySelector(".productPrice");
            const img = card.querySelector(".productImage img") || card.querySelector(".productImageHorizon img");

            card.dataset.defaultName = name?.textContent || "";
            card.dataset.defaultStock = stock?.textContent.replace("Stok: ", "") || "";
            card.dataset.defaultPrice = price?.textContent.replace(/[^\d]/g, "") || "";
            card.dataset.defaultImage = img?.src || "";
            card.dataset.defaultSaved = "true";
        }

        checkboxes.forEach(cb => {
            if (cb.value.toLowerCase() !== "none") {
                cb.replaceWith(cb.cloneNode(true));
            }
        });

        group.querySelectorAll("input[type='checkbox']").forEach(checkbox => {
            if (checkbox.value.toLowerCase() === "none") return;

            checkbox.addEventListener("change", async function () {
                const productId = card.dataset.id;
                const changedColor = this.value;
                const isChecked = this.checked;

                if (!productId) return;

                let history = JSON.parse(card.dataset.displayHistory || "[]");
                const currentDisplay = card.dataset.currentDisplay;
                const defaultColor = card.dataset.defaultColor;

                if (isChecked) {
                    card.dataset.currentDisplay = changedColor;
                    history.push(changedColor);
                    card.dataset.displayHistory = JSON.stringify(history);
                    await updateProductDisplay(card, productId, changedColor);
                } else {
                    const checkedColors = Array.from(group.querySelectorAll('input[type="checkbox"]:checked'))
                        .filter(cb => cb.value.toLowerCase() !== "none")
                        .map(cb => cb.value);

                    if (checkedColors.length === 0) {
                        await updateProductDisplay(card, productId, defaultColor);
                        card.dataset.currentDisplay = defaultColor;
                        card.dataset.displayHistory = JSON.stringify([defaultColor]);
                    } else if (changedColor === currentDisplay) {
                        history = history.filter(color => color !== changedColor);

                        let newDisplayColor = "";
                        for (let i = history.length - 1; i >= 0; i--) {
                            if (checkedColors.includes(history[i])) {
                                newDisplayColor = history[i];
                                break;
                            }
                        }

                        if (!newDisplayColor) {
                            newDisplayColor = defaultColor;
                        }
                        
                        card.dataset.currentDisplay = newDisplayColor;
                        card.dataset.displayHistory = JSON.stringify(history);
                        await updateProductDisplay(card, productId, newDisplayColor);
                    } else {
                        card.dataset.currentDisplay = changedColor;
                        history.push(changedColor);
                        card.dataset.displayHistory = JSON.stringify(history);
                        await updateProductDisplay(card, productId, changedColor);
                    }
                }
            });
        });

        const currentDisplay = card.dataset.currentDisplay;
        if (currentDisplay) {
            updateProductDisplay(card, card.dataset.id, currentDisplay);
        }
    });
}

async function updateProductDisplay(card, productId, color) {
    const name = card.querySelector(".productName");
    const stock = card.querySelector(".productStock");
    const price = card.querySelector(".productPrice");
    const img = card.querySelector(".productImage img") || card.querySelector(".productImageHorizon img");

    try {
        const response = await fetch("/back-end/actions/products/update-product-colours.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `product_id=${encodeURIComponent(productId)}&color=${encodeURIComponent(color)}`
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
}

initProductColorEvents();