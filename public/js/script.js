document.addEventListener("DOMContentLoaded", function () {
    // Delete Confirmation Modal Handler

    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteForm = document.getElementById("deleteForm");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const studentId = this.getAttribute("data-student-id");
            deleteForm.action = `/students/${studentId}`;

            // Show the modal

            const deleteModal = new bootstrap.Modal(
                document.getElementById("deleteModal")
            );
            deleteModal.show();
        });
    });

    // Image Preview for Create/Edit Forms

    const photoInput = document.getElementById("photo");
    if (photoInput) {
        photoInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                const previewContainer =
                    document.querySelector(".img-thumbnail") ||
                    document.querySelector(".bg-light");

                reader.onload = function (e) {
                    if (previewContainer.tagName === "IMG") {
                        previewContainer.src = e.target.result;
                    } else {
                        // Replace placeholder with image

                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.className = "img-thumbnail";
                        img.style.maxWidth = "200px";
                        previewContainer.replaceWith(img);
                    }
                };

                reader.readAsDataURL(file);
            }
        });
    }
});

// Photo Preview with Camera Icon

document.addEventListener("DOMContentLoaded", function () {
    const photoInput = document.getElementById("photo");
    const profileImage = document.querySelector(".profile-image");
    const placeholder = document.querySelector(".profile-image-placeholder");

    photoInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                if (profileImage) {
                    profileImage.src = e.target.result;
                } else {
                    // Replace placeholder with image

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "profile-image rounded-circle";
                    placeholder.replaceWith(img);
                }
            };

            reader.readAsDataURL(file);
        }
    });
});
