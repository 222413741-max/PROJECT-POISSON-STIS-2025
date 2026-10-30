const translations = window.translations || {};
let t = translations[window.currentLang] || {};

function updateLanguage(lang) {
    t = translations[lang];

    document.getElementById(
        "backButton"
    ).innerHTML = `<span></span>${t["back_button"]}`;
    document.getElementById("choosePhotosTitle").textContent =
        t["choose_photos"];
    document.getElementById("photos3").textContent = t["photos_3"];
    document.getElementById("photos4").textContent = t["photos_4"];
    document.getElementById("photos6").textContent = t["photos_6"];
    document.getElementById("takePhotoBtn").textContent = t["take_photo"];

    document.getElementById(
        "editBtn"
    ).innerHTML = `<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.5 9.5L4 13l.646-1.646 9.5-9.5z" /><path fill-rule="evenodd" d="M1 13.5V16h2.5l9.354-9.354-2.5-2.5L1 13.5zM2 14v-1.5L11.5 3.5l1.5 1.5L3.5 15H2z" /></svg>${t["edit_photo"]}`;
    document.getElementById(
        "retakeBtn"
    ).innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 6px;"><path d="M11.534 7H15a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 10.5 7h1.07a4.998 4.998 0 0 0-4.47-3 5 5 0 1 0 4.47 8H11a4 4 0 1 1-3.995-5z" /></svg>${t["retake_photo"]}`;
    document.getElementById("stickersTitle").textContent = t["stickers_title"];
    document.getElementById("instructions1").textContent =
        t["stickers_instruction_1"];
    document.getElementById("instructions2").textContent =
        t["stickers_instruction_2"];
    document.getElementById("instructions3").textContent =
        t["stickers_instruction_3"];
    document.getElementById("backgroundTitle").textContent =
        t["background_title"];
    document.getElementById("backgroundInstruction").textContent =
        t["background_instruction"];
    document.getElementById("customColorLabel").textContent = t["custom_color"];
    document.getElementById("filtersTitle").textContent = t["filters_title"];
    document.getElementById("filterNormal").textContent = t["filter_normal"];
    document.getElementById("filterGrayscale").textContent =
        t["filter_grayscale"];
    document.getElementById("filterVintage").textContent = t["filter_vintage"];
    document.getElementById("filterBright").textContent = t["filter_bright"];
    document.getElementById(
        "downloadBtn"
    ).innerHTML = `⬇ ${t["download_button"]}`;
    document.getElementById(
        "retakeFinalBtn"
    ).innerHTML = `<x-icons.camera />${t["retake_final_button"]}`;

    for (let i = 1; i <= 6; i++) {
        const photoEl = document.getElementById(`photo${i}`);
        if (photoEl && !photoEl.querySelector("img")) {
            photoEl.querySelector(
                "span"
            ).textContent = `${t["photo_label"]} ${i}`;
        }
    }

    const languageCodeSpan = document.getElementById("languageCode");
    const languageFlagSpan = document.getElementById("languageFlag");
    languageCodeSpan.textContent = t["language_code"];
    languageFlagSpan.className = `fi fi-${lang === "en" ? "us" : "id"}`;
}

class PhotoboothApp {
    constructor() {
        this.photos = [];
        this.currentPhotoIndex = 0;
        this.stream = null;
        this.canvas = document.createElement("canvas");
        this.ctx = this.canvas.getContext("2d");
        this.selectedSticker = null;
        this.stickerCounter = 0;
        this.currentFilter = "normal";
        this.photoBackground = "black";
        this.photoCount = 3;

        this.initElements();
        this.initCamera();
        this.bindEvents();
        this.initializeUI();
    }

    initElements() {
        this.videoElement = document.getElementById("videoElement");
        this.takePhotoBtn = document.getElementById("takePhotoBtn");
        this.countdownDisplay = document.getElementById("countdownDisplay");
        this.messageDisplay = document.getElementById("messageDisplay");
        this.actionButtons = document.getElementById("actionButtons");
        this.editSection = document.getElementById("editSection");
        this.cameraSection = document.getElementById("cameraSection");
        this.photosSection = document.getElementById("photosSection");
        this.photoStrip = document.getElementById("photoStrip");
        this.stripPhotos = document.getElementById("stripPhotos");
        this.photosGrid = document.getElementById("photosGrid");
        this.photoCountSelector = document.getElementById("photoCountSelector");
        this.customColorPicker = document.getElementById("customColorPicker");
    }

    initializeUI() {
        this.editSection.classList.add("hidden");
        this.actionButtons.classList.add("hidden");
        this.messageDisplay.classList.add("hidden");
        this.countdownDisplay.classList.add("hidden");

        // Pastiin elemen foto dan kamera terlihat
        this.cameraSection.style.display = "flex";
        this.photosSection.style.display = "block";
        this.photoCountSelector.style.display = "block";
        this.takePhotoBtn.style.display = "block";

        // Setup grid foto awal
        this.setupPhotoGrid();
    }

    async initCamera() {
        try {
            this.stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    ideal: 640,
                    height: { ideal: 480 },
                    facingMode: "user",
                },
            });
            this.videoElement.srcObject = this.stream;
        } catch (err) {
            console.error("Error accessing camera:", err);
            this.messageDisplay.textContent = t.camera_denied;
            this.messageDisplay.classList.remove("hidden");
        }
    }

    bindEvents() {
        this.takePhotoBtn.addEventListener("click", () =>
            this.startPhotoSequence()
        );
        document
            .getElementById("editBtn")
            .addEventListener("click", () => this.showEditSection());
        document
            .getElementById("retakeBtn")
            .addEventListener("click", () => this.retakePhotos());
        document
            .getElementById("retakeFinalBtn")
            .addEventListener("click", () => this.retakePhotos());
        document
            .getElementById("downloadBtn")
            .addEventListener("click", () => this.downloadPhotostrip());

        document.querySelectorAll(".count-option").forEach((option) => {
            option.addEventListener("click", (e) =>
                this.selectPhotoCount(e.target.dataset.count, e.target)
            );
        });

        document.querySelectorAll(".sticker").forEach((sticker) => {
            sticker.addEventListener("click", (e) => {
                const selectedStickerElement = e.target.closest(".sticker");
                const stickerUrl = selectedStickerElement.dataset.stickerUrl;
                this.selectSticker(stickerUrl, selectedStickerElement);
            });
        });

        document.querySelectorAll("[data-photo-bg]").forEach((option) => {
            option.addEventListener("click", (e) =>
                this.changePhotoBackground(e.target.dataset.photoBg, e.target)
            );
        });

        this.customColorPicker.addEventListener("change", (e) =>
            this.changeCustomBackground(e.target.value)
        );

        document.querySelectorAll(".filter-btn").forEach((btn) => {
            btn.addEventListener("click", (e) =>
                this.applyFilter(e.target.dataset.filter, e.target)
            );
        });
    }

    selectPhotoCount(count, element) {
        document
            .querySelectorAll(".count-option")
            .forEach((option) => option.classList.remove("active"));
        element.classList.add("active");
        this.photoCount = parseInt(count);
        this.setupPhotoGrid();
    }

    setupPhotoGrid() {
        this.photosGrid.innerHTML = "";
        this.photosGrid.className = "photos-grid";

        if (this.photoCount === 4) {
            this.photosGrid.classList.add("grid-2x2");
        } else if (this.photoCount === 6) {
            this.photosGrid.classList.add("grid-2x3");
        }

        for (let i = 1; i <= this.photoCount; i++) {
            const placeholder = document.createElement("div");
            placeholder.className = "photo-placeholder";
            placeholder.id = `photo${i}`;
            placeholder.innerHTML = `<span style="color: #999; font-size: 14px;">${t.photo_label} ${i}</span>`;
            this.photosGrid.appendChild(placeholder);
        }
    }

    async startPhotoSequence() {
        this.takePhotoBtn.disabled = true;
        this.photoCountSelector.style.display = "none";
        this.currentPhotoIndex = 0;
        this.photos = [];
        this.clearPhotoPreviews();

        for (let i = 0; i < this.photoCount; i++) {
            await this.takePhotoWithCountdown(i);
        }

        this.completePhotoSequence();
    }

    async takePhotoWithCountdown(index) {
        this.countdownDisplay.classList.remove("hidden");
        this.messageDisplay.classList.add("hidden");

        for (let count = 3; count > 0; count--) {
            this.countdownDisplay.textContent = count;
            await this.delay(1000);
        }

        this.countdownDisplay.textContent = t.countdown_message_smile;
        await this.delay(500);

        const photo = this.capturePhoto();
        this.photos.push(photo);
        this.displayPhoto(photo, index);

        this.countdownDisplay.classList.add("hidden");

        if (index < this.photoCount - 1) {
            const remaining = this.photoCount - index - 1;
            this.messageDisplay.textContent =
                remaining === 1
                    ? t.countdown_message_last
                    : `${remaining} ${t.countdown_message_remaining}`;
            this.messageDisplay.classList.remove("hidden");
            await this.delay(1500);
            this.messageDisplay.classList.add("hidden");
        }
    }

    capturePhoto() {
        this.canvas.width = this.videoElement.videoWidth;
        this.canvas.height = this.videoElement.videoHeight;
        this.ctx.save();
        this.ctx.scale(-1, 1);
        this.ctx.drawImage(this.videoElement, -this.canvas.width, 0);
        this.ctx.restore();
        return this.canvas.toDataURL("image/jpeg", 0.9);
    }

    displayPhoto(photo, index) {
        const photoElement = document.getElementById(`photo${index + 1}`);
        photoElement.innerHTML = `<img src="${photo}" alt="${t.photo_label} ${
            index + 1
        }">`;
        photoElement.classList.add("filled");
    }

    completePhotoSequence() {
        this.messageDisplay.textContent = t.message_success;
        this.messageDisplay.classList.remove("hidden");
        this.actionButtons.classList.remove("hidden");
        this.takePhotoBtn.style.display = "none";
    }

    clearPhotoPreviews() {
        for (let i = 1; i <= this.photoCount; i++) {
            const photoEl = document.getElementById(`photo${i}`);
            if (photoEl) {
                photoEl.innerHTML = `<span style="color: #999; font-size: 14px;">${t.photo_label} ${i}</span>`;
                photoEl.classList.remove("filled");
            }
        }
    }

    showEditSection() {
        this.cameraSection.style.display = "none";
        this.photosSection.style.display = "none";
        this.actionButtons.classList.add("hidden");
        this.messageDisplay.classList.add("hidden");
        this.countdownDisplay.classList.add("hidden");
        this.photoCountSelector.style.display = "none";
        this.editSection.classList.remove("hidden");
        this.editSection.style.display = "grid";
        this.createPhotostrip();
    }

    createPhotostrip() {
        this.stripPhotos.innerHTML = "";
        this.photoStrip.className = `photo-strip layout-${this.photoCount}`;
        this.stripPhotos.className = `strip-photos layout-${this.photoCount}`;

        this.photos.forEach((photo, index) => {
            const stripPhoto = document.createElement("div");
            stripPhoto.className = `strip-photo size-${this.photoCount}`;
            stripPhoto.style.background = "#fff";
            stripPhoto.innerHTML = `<img src="${photo}" alt="${
                t.photo_label
            } Strip ${index + 1}" style="filter: ${this.getFilterStyle()}">`;
            this.stripPhotos.appendChild(stripPhoto);
        });

        const photoStripContainer = this.stripPhotos.parentElement;
        let globalStickerOverlay = photoStripContainer.querySelector(
            ".global-sticker-overlay"
        );
        if (globalStickerOverlay) {
            globalStickerOverlay.remove();
        }

        globalStickerOverlay = document.createElement("div");
        globalStickerOverlay.className = "global-sticker-overlay";
        globalStickerOverlay.style.cssText = `position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 50;`;
        globalStickerOverlay.addEventListener("click", (e) =>
            this.addStickerToPhotostrip(e)
        );
        globalStickerOverlay.style.pointerEvents = "auto";

        photoStripContainer.appendChild(globalStickerOverlay);
        this.updateStripStyle();
    }

    selectSticker(stickerUrl, element) {
        document
            .querySelectorAll(".sticker")
            .forEach((s) => s.classList.remove("selected"));
        element.classList.add("selected");
        this.selectedSticker = stickerUrl;
    }

    addStickerToPhotostrip(event) {
        if (!this.selectedSticker) return;
        if (event.target.closest(".sticker-item")) return;

        const globalOverlay = event.currentTarget;
        const rect = globalOverlay.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const stickerImageUrl = this.selectedSticker;

        const stickerEl = document.createElement("div");
        stickerEl.className = "sticker-item";
        stickerEl.style.left = `${x}px`;
        stickerEl.style.top = `${y}px`;
        stickerEl.style.transform = "translate(-50%, -50%)";
        stickerEl.style.position = "absolute";
        stickerEl.style.zIndex = "60";

        const imgEl = document.createElement("img");
        imgEl.src = stickerImageUrl;
        imgEl.alt = `Sticker`;
        imgEl.crossOrigin = "anonymous";
        imgEl.style.cssText =
            "width: 40px; height: 40px; object-fit: contain; pointer-events: none;";
        imgEl.onerror = () => {
            console.error("Failed to load sticker image:", stickerImageUrl);
        };

        stickerEl.appendChild(imgEl);
        stickerEl.addEventListener("dblclick", (e) => {
            e.stopPropagation();
            stickerEl.remove();
        });

        this.makeDraggableWithConstraints(stickerEl, globalOverlay);
        globalOverlay.appendChild(stickerEl);
    }

    makeDraggableWithConstraints(element, container) {
        let isDragging = false;
        let startX, startY, startLeft, startTop;

        element.addEventListener("mousedown", (e) => {
            isDragging = true;
            startX = e.clientX;
            startY = e.clientY;
            startLeft = parseInt(element.style.left);
            startTop = parseInt(element.style.top);
            e.preventDefault();
            e.stopPropagation();
        });

        document.addEventListener("mousemove", (e) => {
            if (!isDragging) return;
            const deltaX = e.clientX - startX;
            const deltaY = e.clientY - startY;
            let newLeft = startLeft + deltaX;
            let newTop = startTop + deltaY;
            const containerRect = container.getBoundingClientRect();
            const elementSize = 40;
            newLeft = Math.max(
                elementSize / 2,
                Math.min(containerRect.width - elementSize / 2, newLeft)
            );
            newTop = Math.max(
                elementSize / 2,
                Math.min(containerRect.height - elementSize / 2, newTop)
            );
            element.style.left = `${newLeft}px`;
            element.style.top = `${newTop}px`;
        });

        document.addEventListener("mouseup", () => {
            isDragging = false;
        });
    }

    updateStripStyle() {
        const backgrounds = {
            black: "#000000",
            white: "#ffffff",
            pink: "#ff69b4",
            lightblue: "#87ceeb",
            lightgreen: "#98fb98",
            plum: "#dda0dd",
        };
        const bgColor = this.photoBackground.startsWith("#")
            ? this.photoBackground
            : backgrounds[this.photoBackground] || "#000";
        this.photoStrip.style.background = bgColor;
        const dateEl = this.photoStrip.querySelector(".strip-date");
        const isLightColor = this.isLightColor(bgColor);
        dateEl.style.color = isLightColor ? "#000" : "#fff";
    }

    isLightColor(color) {
        const hex = color.replace("#", "");
        const r = parseInt(hex.substr(0, 2), 16);
        const g = parseInt(hex.substr(2, 2), 16);
        const b = parseInt(hex.substr(4, 2), 16);
        const brightness = (r * 299 + g * 587 + b * 114) / 1000;
        return brightness > 210;
    }

    getFilterStyle() {
        const filters = {
            normal: "none",
            sepia: "sepia(100%)",
            grayscale: "grayscale(100%)",
            vintage: "sepia(50%) contrast(120%) brightness(90%)",
            bright: "brightness(120%) contrast(110%)",
        };
        return filters[this.currentFilter] || "none";
    }

    changePhotoBackground(bg, element) {
        document
            .querySelectorAll("[data-photo-bg]")
            .forEach((option) => option.classList.remove("active"));
        element.classList.add("active");
        this.photoBackground = bg;
        this.updateStripStyle();
    }

    changeCustomBackground(color) {
        document
            .querySelectorAll("[data-photo-bg]")
            .forEach((option) => option.classList.remove("active"));
        this.photoBackground = color;
        this.updateStripStyle();
    }

    applyFilter(filter, button) {
        document
            .querySelectorAll(".filter-btn")
            .forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");
        this.currentFilter = filter;
        document.querySelectorAll(".strip-photo img").forEach((img) => {
            img.style.filter = this.getFilterStyle();
        });
    }

    async downloadPhotostrip() {
        const stripCanvas = document.createElement("canvas");
        const stripCtx = stripCanvas.getContext("2d");

        const scaleFactor = 2.5;

        let canvasWidth, canvasHeight;
        if (this.photoCount === 3) {
            canvasWidth = 320 * scaleFactor;
            canvasHeight = 680 * scaleFactor;
        } else if (this.photoCount === 4) {
            canvasWidth = 450 * scaleFactor;
            canvasHeight = 500 * scaleFactor;
        } else if (this.photoCount === 6) {
            canvasWidth = 450 * scaleFactor;
            canvasHeight = 700 * scaleFactor;
        }

        stripCanvas.width = canvasWidth;
        stripCanvas.height = canvasHeight;
        stripCtx.imageSmoothingEnabled = true;
        stripCtx.imageSmoothingQuality = "high";

        const backgrounds = {
            black: "#000",
            white: "#fff",
            pink: "#ff69b4",
            lightblue: "#87ceeb",
            lightgreen: "#98fb98",
            plum: "#dda0dd",
        };
        const bgColor = this.photoBackground.startsWith("#")
            ? this.photoBackground
            : backgrounds[this.photoBackground] || "#000";

        stripCtx.fillStyle = bgColor;
        this.roundRect(
            stripCtx,
            0,
            0,
            canvasWidth,
            canvasHeight,
            12 * scaleFactor
        );
        stripCtx.fill();

        const positions = this.getPhotoPositionsWithSpacing(
            canvasWidth,
            canvasHeight,
            scaleFactor
        );

        const imgElements = document.querySelectorAll(".strip-photo img");
        const imagePromises = Array.from(imgElements).map((imgEl, index) => {
            return new Promise((resolve) => {
                const img = new Image();
                img.crossOrigin = "anonymous";
                img.onload = () => {
                    const pos = positions[index];
                    stripCtx.save();
                    this.roundRect(
                        stripCtx,
                        pos.x,
                        pos.y,
                        pos.width,
                        pos.height,
                        6 * scaleFactor
                    );
                    stripCtx.clip();
                    const scale = Math.max(
                        pos.width / img.width,
                        pos.height / img.height
                    );
                    const scaledWidth = img.width * scale;
                    const scaledHeight = img.height * scale;
                    const offsetX = (pos.width - scaledWidth) / 2;
                    const offsetY = (pos.height - scaledHeight) / 2;
                    if (this.currentFilter !== "normal") {
                        stripCtx.filter = this.getFilterStyle();
                    }
                    stripCtx.drawImage(
                        img,
                        pos.x + offsetX,
                        pos.y + offsetY,
                        scaledWidth,
                        scaledHeight
                    );
                    stripCtx.filter = "none";
                    stripCtx.restore();
                    resolve();
                };
                img.onerror = () => {
                    console.error(
                        "Failed to load photo for canvas drawing:",
                        imgEl.src
                    );
                    resolve();
                };
                img.src = imgEl.src;
            });
        });

        await Promise.all(imagePromises);

        const globalOverlay = document.querySelector(".global-sticker-overlay");
        if (globalOverlay) {
            const stickers = globalOverlay.querySelectorAll(".sticker-item");
            const overlayRect = globalOverlay.getBoundingClientRect();

            const stickerPromises = Array.from(stickers).map((sticker) => {
                return new Promise((stickerResolve) => {
                    const stickerImg = sticker.querySelector("img");
                    const img = new Image();
                    img.crossOrigin = "anonymous";
                    img.onload = () => {
                        const stickerRect = sticker.getBoundingClientRect();
                        const relativeX =
                            stickerRect.left -
                            overlayRect.left +
                            stickerRect.width / 2;
                        const relativeY =
                            stickerRect.top -
                            overlayRect.top +
                            stickerRect.height / 2;
                        const xRatio = relativeX / overlayRect.width;
                        const yRatio = relativeY / overlayRect.height;
                        const canvasStickerX = xRatio * canvasWidth;
                        const canvasStickerY = yRatio * canvasHeight;
                        const stickerSize = 60 * scaleFactor;
                        const imgAspect = img.width / img.height;
                        let drawWidth = stickerSize;
                        let drawHeight = stickerSize;
                        if (imgAspect > 1) {
                            drawHeight = stickerSize / imgAspect;
                        } else {
                            drawWidth = stickerSize * imgAspect;
                        }
                        stripCtx.drawImage(
                            img,
                            canvasStickerX - drawWidth / 2,
                            canvasStickerY - drawHeight / 2,
                            drawWidth,
                            drawHeight
                        );
                        stickerResolve();
                    };
                    img.onerror = () => {
                        console.error(
                            "Failed to load image for canvas drawing:",
                            stickerImg.src
                        );
                        stickerResolve();
                    };
                    img.src = stickerImg.src;
                });
            });

            await Promise.all(stickerPromises);
        }

        const dateText = t["date_text"] || "I'm Ready For";

        const logoImg = new Image();
        logoImg.crossOrigin = "anonymous";
        logoImg.src = "/img/logo-2025-icon.png";

        await new Promise((resolve) => {
            logoImg.onload = resolve;
            logoImg.onerror = resolve;
        });

        // Setup text properties
        stripCtx.fillStyle = this.isLightColor(bgColor) ? "#000" : "#fff";
        stripCtx.font = `italic ${20 * scaleFactor}px Georgia, serif`;
        stripCtx.textAlign = "left";

        // Ukur teks dan logo
        const textMetrics = stripCtx.measureText(dateText);
        const textWidth = textMetrics.width;
        const logoSize = 70 * scaleFactor;
        const spacing = 8 * scaleFactor;

        const totalWidth = textWidth + spacing + logoSize;

        const startX = (canvasWidth - totalWidth) / 2;
        const textY = canvasHeight - 25 * scaleFactor;

        stripCtx.fillText(dateText, startX, textY);

        // Draw logo di sebelah text
        if (logoImg.complete && logoImg.naturalWidth > 0) {
            const logoX = startX + textWidth + spacing;
            const logoY = textY - logoSize + 8 * scaleFactor; // Adjust vertical alignment
            stripCtx.drawImage(logoImg, logoX, logoY, logoSize, logoSize);
        }

        const link = document.createElement("a");
        link.download = "photostrip.png";
        link.href = stripCanvas.toDataURL("image/png");
        link.click();
    }

    // Fungsi isLightColor dipindahkan ke dalam kelas
    isLightColor(color) {
        const hex = color.replace("#", "");
        const r = parseInt(hex.substr(0, 2), 16);
        const g = parseInt(hex.substr(2, 2), 16);
        const b = parseInt(hex.substr(4, 2), 16);
        const brightness = (r * 299 + g * 587 + b * 114) / 1000;
        return brightness > 210;
    }

    // Fungsi roundRect dipindahkan ke dalam kelas
    roundRect(ctx, x, y, width, height, radius) {
        ctx.beginPath();
        ctx.moveTo(x + radius, y);
        ctx.lineTo(x + width - radius, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
        ctx.lineTo(x + width, y + height - radius);
        ctx.quadraticCurveTo(
            x + width,
            y + height,
            x + width - radius,
            y + height
        );
        ctx.lineTo(x + radius, y + height);
        ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
        ctx.lineTo(x, y + radius);
        ctx.quadraticCurveTo(x, y, x + radius, y);
        ctx.closePath();
    }

    getPhotoPositionsWithSpacing(canvasWidth, canvasHeight, scaleFactor = 1) {
        const margin = 20 * scaleFactor;
        const spacing = 8 * scaleFactor;
        const positions = [];

        if (this.photoCount === 3) {
            const photoWidth = canvasWidth - margin * 2;
            const photoHeight =
                (canvasHeight - margin * 2 - spacing * 2 - 40 * scaleFactor) /
                3;
            for (let i = 0; i < 3; i++) {
                positions.push({
                    x: margin,
                    y: margin + i * (photoHeight + spacing),
                    width: photoWidth,
                    height: photoHeight,
                });
            }
        } else if (this.photoCount === 4) {
            const photoWidth = (canvasWidth - margin * 2 - spacing) / 2;
            const photoHeight =
                (canvasHeight - margin * 2 - spacing - 40 * scaleFactor) / 2;
            for (let i = 0; i < 4; i++) {
                const row = Math.floor(i / 2);
                const col = i % 2;
                positions.push({
                    x: margin + col * (photoWidth + spacing),
                    y: margin + row * (photoHeight + spacing),
                    width: photoWidth,
                    height: photoHeight,
                });
            }
        } else if (this.photoCount === 6) {
            const photoWidth = (canvasWidth - margin * 2 - spacing) / 2;
            const photoHeight =
                (canvasHeight - margin * 2 - spacing * 2 - 40 * scaleFactor) /
                3;
            for (let i = 0; i < 6; i++) {
                const row = Math.floor(i / 2);
                const col = i % 2;
                positions.push({
                    x: margin + col * (photoWidth + spacing),
                    y: margin + row * (photoHeight + spacing),
                    width: photoWidth,
                    height: photoHeight,
                });
            }
        }
        return positions;
    }

    retakePhotos() {
        this.photos = [];
        this.selectedSticker = null;
        this.clearPhotoPreviews();
        this.setupPhotoGrid();
        this.cameraSection.style.display = "flex";
        this.photosSection.style.display = "block";
        this.photoCountSelector.style.display = "block";

        this.editSection.classList.add("hidden");
        this.editSection.style.display = "none";
        this.actionButtons.classList.add("hidden");
        this.messageDisplay.classList.add("hidden");
        this.countdownDisplay.classList.add("hidden");
        this.takePhotoBtn.style.display = "block";
        this.takePhotoBtn.disabled = false;
        document
            .querySelectorAll(".sticker")
            .forEach((s) => s.classList.remove("selected"));
        const globalOverlay = document.querySelector(".global-sticker-overlay");
        if (globalOverlay) {
            globalOverlay.remove();
        }
    }
    delay(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const languageSwitcher = document.querySelector(".language-switcher");
    const dropdownContent = document.querySelector(".dropdown-content");

    languageSwitcher.addEventListener("click", function (event) {
        event.stopPropagation();
        const isCurrentlyOpen = dropdownContent.style.display === "block";
        dropdownContent.style.display = isCurrentlyOpen ? "none" : "block";
        languageSwitcher.classList.toggle("open", !isCurrentlyOpen);
    });

    document.addEventListener("click", function () {
        dropdownContent.style.display = "none";
        languageSwitcher.classList.remove("open");
    });

    document.querySelectorAll(".dropdown-content a").forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const newLang = this.getAttribute("data-lang");
            updateLanguage(newLang);
        });
    });

    new PhotoboothApp();
});
