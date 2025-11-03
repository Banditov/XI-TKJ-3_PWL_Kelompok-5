document.querySelectorAll(".productColor input[type='checkbox']").forEach(checkbox => {
    checkbox.addEventListener("change", async function () {
        const card = this.closest(".stationeryProduct, .bookProduct");
        const productId = card?.dataset?.id;
        const color = this.value;

        if (!productId || !color) {
            console.error("Missing product ID or color!", { productId, color });
            return;
        }

        const nameEl = card.querySelector(".productName");
        const stockEl = card.querySelector(".productStock");
        const priceEl = card.querySelector(".productPrice");
        const imgEl =
            card.querySelector(".productImage img") ||
            card.querySelector(".productImageHorizon img");

        if (!card.dataset.defaultSaved) {
            card.dataset.defaultName = nameEl?.textContent || "";
            card.dataset.defaultStock = stockEl?.textContent.replace("Stok: ", "") || "";
            card.dataset.defaultPrice = priceEl?.textContent.replace(/[^\d]/g, "") || "";
            card.dataset.defaultImage = imgEl?.src || "";
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
            if (nameEl) nameEl.textContent = card.dataset.defaultName;
            if (stockEl) stockEl.textContent = "Stok: " + card.dataset.defaultStock;
            if (priceEl)
                priceEl.textContent =
                    "Rp " + new Intl.NumberFormat("id-ID").format(card.dataset.defaultPrice);
            if (imgEl) imgEl.src = card.dataset.defaultImage;
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

            if (nameEl) nameEl.textContent = data.product_name;
            if (stockEl) stockEl.textContent = "Stok: " + data.stock;
            if (priceEl)
                priceEl.textContent =
                    "Rp " + new Intl.NumberFormat("id-ID").format(data.price);
            if (imgEl) imgEl.src = "/back-end/database/images/" + data.image + ".png";
        } catch (err) {
            console.error("Fetch failed:", err);
        }
    });
});
