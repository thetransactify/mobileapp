(function ($) {

    const sidebar = document.getElementById('sidebar');

    if (sidebar) {

        const sidebarToggleBtn = document.getElementById("sidebarToggle");
        sidebarToggleBtn.addEventListener("click", toggleSidebar);

        const overlay = document.querySelector('.sidebar-overlay');

        function toggleSidebar() {
            this.classList.toggle('active');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        };

        overlay.addEventListener("click", function (event) {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
            sidebarToggleBtn.classList.remove("active");
        });

    };




    const datePickerInput = document.querySelector('#datePickerInput');

    $(datePickerInput).daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
            format: "DD/MM/YYYY",
        },
    });

    $(datePickerInput).on("apply.daterangepicker", function (ev, picker) {
        $(this).val(picker.startDate.format("DD/MM/YYYY"));
        $(this).attr("value", picker.startDate.format("DD/MM/YYYY"));

        let parentFormId = $(this).closest("form").attr("id");

        saveToSessionStorage(this, `${parentFormId}Data`);
    });

    // Logics End --------------


    function updatePlaceholderClass(selectElement) {
        const current = $(selectElement).closest(".input-wrapper").find(".nice-select").find(".current");
        const selectedOption = $(selectElement).find("option:checked");

        const displayValue = selectedOption.data('display');

        if (displayValue == current.text()) {
            current.attr("data-type", "placeholder");
        } else {
            current.attr("data-type", "current");
        }
    }


    $(".custom-select").each(function () {
        const parentForm = $(this).closest("form")[0];
        const parentFormId = $(this).closest("form").attr("id");
        const formKey = `${parentFormId}Data`;

        $(this).niceSelect();


        const niceSelectId = $(this).attr('id');
        const niceSelectIsSave = $(this).attr('data-save');

        // Load saved value from sessionStorage
        const savedValue = JSON.parse(sessionStorage.getItem(formKey))?.[this.name];
        if (savedValue) {
            $(this).val(savedValue).niceSelect("update");
        }

        updatePlaceholderClass(this);

        loadUploadInputOnSelect("selectGST", this.value, "registered", document.querySelector("#GST_UploadFile"));
        loadUploadInputOnSelect("selectMSMSE", this.value, "registered", document.querySelector("#MSMSE_UploadFile"));

        $(this).on("change", function () {

            updatePlaceholderClass(this);

            if (!niceSelectIsSave) {
                saveToSessionStorage(this, formKey);
            }

            if (niceSelectId === "existingEntitySelect") {
                parentForm.requestSubmit();
            }

            if (parentForm) {
                const eventChange = new Event('change');
                parentForm.dispatchEvent(eventChange);
            }

            loadUploadInputOnSelect("selectGST", this.value, "registered", document.querySelector("#GST_UploadFile"));
            loadUploadInputOnSelect("selectMSMSE", this.value, "registered", document.querySelector("#MSMSE_UploadFile"));
        });


        function loadUploadInputOnSelect(selectId, selectInputValue, conditionValue, uploadBoxElement) {
            if (niceSelectId == selectId) {
                if (selectInputValue == conditionValue) {
                    uploadBoxElement.setAttribute("data-display", "true");
                    uploadBoxElement.querySelector("input").setAttribute("required", "");

                } else {
                    uploadBoxElement.setAttribute("data-display", "false");
                    uploadBoxElement.querySelector("input").removeAttribute("required");
                }
            }

            if (parentForm) {
                const eventChange = new Event('change');
                parentForm.dispatchEvent(eventChange);
            }
        }

        $(this).closest("form").on("reset", function () {
            $(this).val("").niceSelect("update");
            updatePlaceholderClass(this);
        });

    });




    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', () => {

            const passwordInput = button.closest('.password-input-wrapper').querySelector('input');

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            button.setAttribute("data-state", type === 'password' ? 'hidden' : 'shown');
        });
    });

    const passwordInputWrappers = document.querySelectorAll('.password-input-wrapper');

    passwordInputWrappers.forEach(wrapper => {
        const passwordInput = wrapper.querySelector('input');
        const invalidFeedback = wrapper.nextElementSibling;

        function handlePasswordInputValidation() {
            if (passwordInput.value.length < 8) {
                invalidFeedback.style.display = 'block';
                passwordInput.classList.add('is-invalid');
                passwordInput.setCustomValidity("Password must be at least 8 characters long");
            } else {
                invalidFeedback.style.display = 'none';
                passwordInput.classList.remove('is-invalid');
                passwordInput.setCustomValidity("");
            }
        };


        wrapper.closest('form').addEventListener('submit', () => {
            handlePasswordInputValidation();
        });

        passwordInput.addEventListener('input', () => {
            handlePasswordInputValidation();
        });

    });

    document.addEventListener("DOMContentLoaded", function () {

        function validatePhoneInputs() {
            const phoneNumberInputs = $(`input[type="tel"]`);

            phoneNumberInputs.each(function (index) {
                const input = $(this);

                input.on('input', function () {
                    const value = input.val();
                    input.val(value.replace(/[^0-9]/g, ''));
                    const inputValue = input.val().trim();

                    if (!/^[0-9]{10}$/.test(inputValue)) {
                        input.addClass("is-invalid");
                        this.setCustomValidity("Invalid phone number.");
                        isFormValid = false;
                    } else {
                        input.removeClass("is-invalid");
                        this.setCustomValidity("");
                    }
                });
            });
        };

        validatePhoneInputs();


        document.getElementById('pincode')?.addEventListener('input', function () {
            const regex = /^[0-9]{6}$/;

            this.value = this.value.replace(/[^0-9]/g, '');

            if (regex.test(this.value)) {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
            } else {
                this.setCustomValidity('Please enter a valid 6-digit pincode');
                this.classList.add('is-invalid');
            }
        });


        document.getElementById('accountNumber')?.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });

        document.getElementById('ifsc')?.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });
    })



    function getQueryParam(param) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        return urlParams.get(param);
    }


    // document.addEventListener("DOMContentLoaded", function () {
    //     const savedFile = localStorage.getItem("savedFilePath");  // Example: "/assets/user-file.jpg"
    //     const savedType = localStorage.getItem("savedFileType");  // Example: "image/jpeg"

    //     if (savedFile) {
    //         document.querySelector(".upload-box").setAttribute("data-saved-file", savedFile);
    //         document.querySelector(".upload-box").setAttribute("data-saved-type", savedType);
    //     }

    //     loadCustomFileUpload();
    // });


    function loadCustomFileUpload() {
        document.querySelectorAll('.file-input').forEach(fileInput => {
            const parent = fileInput.closest('.upload-box');
            const previewContainer = parent.querySelector('.preview-container');
            const canvas = parent.querySelector('.preview-canvas');
            const fileName = parent.querySelector('.file-name');
            const fileSize = parent.querySelector('.file-size');
            const removeBtn = parent.querySelector('.remove-file-btn');
            const ctx = canvas.getContext('2d');


            // Get saved file path and type from data attributes
            const savedFilePath = parent.getAttribute("data-saved-file");
            const savedFileType = parent.getAttribute("data-saved-type");

            function loadSavedFile() {
                if (!savedFilePath) return;

                if (savedFileType === "application/pdf") {
                    previewContainer.style.height = "85px";
                    fileName.textContent = savedFilePath.split('/').pop();
                    fileSize.textContent = "";
                } else {
                    const img = new Image();
                    img.src = savedFilePath;

                    img.onload = function () {
                        previewContainer.style.height = "170px";
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.drawImage(img, 0, 0, img.width, img.height);

                        fileName.textContent = savedFilePath.split('/').pop();
                        fileSize.textContent = "";
                    };
                }

                parent.classList.add("loaded");
                previewContainer.style.opacity = "1";
            }

            // Handle file selection (from input)
            async function handleFile(file) {

                if (file.type == "application/pdf") {
                    const containerHeight = 85;

                    previewContainer.style.height = `${containerHeight}px`;

                    // Update the file name and size
                    fileName.textContent = file.name;
                    const sizeInKB = (file.size / 1024).toFixed(2);
                    fileSize.textContent = sizeInKB > 1024
                        ? `${(sizeInKB / 1024).toFixed(2)} MB`
                        : `${sizeInKB} KB`;

                    // Trigger 'loaded' state for parent container and preview
                    parent.classList.add("loaded");
                    previewContainer.style.opacity = "1";

                } else {
                    const imgURL = URL.createObjectURL(file);
                    const img = new Image();
                    img.src = imgURL;

                    img.onload = function () {
                        const containerHeight = 170;
                        const containerWidth = previewContainer.offsetWidth;

                        previewContainer.style.height = `${containerHeight}px`;

                        const scale = containerHeight / img.height;
                        const drawWidth = img.width * scale;
                        const drawHeight = img.height * scale;

                        // Set canvas size
                        canvas.width = drawWidth;
                        canvas.height = drawHeight;

                        // Draw image
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0, drawWidth, drawHeight);

                        // Update the file name and size
                        fileName.textContent = file.name;
                        const sizeInKB = (file.size / 1024).toFixed(2);
                        fileSize.textContent = sizeInKB > 1024
                            ? `${(sizeInKB / 1024).toFixed(2)} MB`
                            : `${sizeInKB} KB`;

                        // Trigger 'loaded' state for parent container and preview
                        parent.classList.add("loaded");
                        previewContainer.style.opacity = "1";
                    };

                    img.onerror = function () {
                        console.error("Error loading the image.");
                    };
                }


            }

            fileInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    handleFile(file);
                }
            });

            parent.addEventListener('dragover', function (event) {
                event.preventDefault();
                this.classList.add('dragover');
            });

            parent.addEventListener('dragleave', function () {
                this.classList.remove('dragover');
            });

            // Handle file drop (drag-and-drop)
            parent.addEventListener('drop', function (event) {
                event.preventDefault();
                this.classList.remove('dragover');

                const file = event.dataTransfer.files[0];

                if (file) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    handleFile(file);
                };

                // Trigger change event on the file input
                fileInput.dispatchEvent(new Event('change', { bubbles: true }));
            });

            previewContainer.addEventListener("click", function (e) {
                e.stopPropagation();
            })

            removeBtn.addEventListener("click", function (event) {
                event.stopPropagation();

                fileInput.value = null;

                const form = parent.closest('form');
                if (form) {
                    const eventChange = new Event('change');
                    form.dispatchEvent(eventChange);
                }

                parent.classList.remove("loaded");
                previewContainer.style.height = "0";
                previewContainer.style.opacity = "0";

                // Clear canvas and reset canvas size
                canvas.width = 0;
                canvas.height = 0;
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Clear file info
                fileName.textContent = "";
                fileSize.textContent = "";
            });

            parent.addEventListener("click", function (event) {
                if (event.target !== removeBtn) {
                    fileInput.click();
                }
            });

            loadSavedFile();
        });
    };

    loadCustomFileUpload();



    function otherDocumentAdding() {
        const addButton = document.getElementById("addOtherDocument");
        const otherDocumentsWrapper = document.querySelector(".other-documents-wrapper");
        const otherDocumentsList = otherDocumentsWrapper.querySelector(".other-documents-list");
        let docIndexes = []; // Track indexes dynamically


        addButton.addEventListener("click", function () {
            otherDocumentsWrapper.setAttribute("data-display", "true");

            const newIndex = docIndexes.length > 0 ? Math.max(...docIndexes) + 1 : 1;
            docIndexes.push(newIndex);

            // Create and insert a new document entry without resetting existing ones
            addNewDocument(newIndex);
        });

        function addNewDocument(index) {
            const docCard = document.createElement("div");
            docCard.classList.add("docCard");

            docCard.innerHTML =
                `<span class="remove-btn"><i class="bi bi-trash"></i></span>
            <div class="input-wrapper">
                <span class="input-title">Document Name</span>
                <input type="text" class="form-control" name="otherDocTitle_${index}" placeholder="Enter document name" required>
            </div>
    
            <div class="input-wrapper">
                <span class="input-title">Document File</span>
                <div class="upload-box">
                    <input type="file" class="file-input" accept="image/png, image/jpeg, application/pdf" name="otherDocFile_${index}" required>
                    <span class="drop-text">
                        <i class="bi bi-cloud-upload"></i>
                        <p>Drop file to Attach, or <span class="browse-text">browse</span></p>
                    </span>
    
                    <div class="preview-container">
                        <canvas class="preview-canvas"></canvas>
                        <div class="file-info">
                            <span class="file-name"></span>
                            <span class="file-size"></span>
                        </div>
                        <button class="remove-file-btn" type="button">Remove</button>
                    </div>
                </div>
            </div>`;

            // Attach remove event for this specific card
            docCard.querySelector(".remove-btn").addEventListener("click", function () {
                docIndexes = docIndexes.filter(id => id !== index);
                docCard.remove();

                if (docIndexes.length == 0) {
                    otherDocumentsWrapper.setAttribute("data-display", false);
                }
            });

            // Append only the new element (without clearing existing ones)
            otherDocumentsList.appendChild(docCard);

            // Call the custom file upload function to initialize file input behavior for this card
            loadCustomFileUpload();
        };

    }

    if (document.getElementById("addOtherDocument")) {
        otherDocumentAdding();
    }


    const tabs = document.querySelectorAll(".tab-item a");

    tabs.forEach((tab, index) => {
        if(tab.classList.contains("tab-active")) {
            tab.scrollIntoView({ behavior: "smooth", inline: "center" })
        }
    });


    document.addEventListener("DOMContentLoaded", () => {
        if (document.querySelectorAll(".field-custom")) {
            document.querySelectorAll(".field-custom").forEach(field => {

                const editBtn = field.querySelector("button.edit-btn");
                const saveBtn = field.querySelector("button.save-btn");
                const closeBtn = field.querySelector("button.close-btn");
                const inputElement = field.querySelector("input");
                const currentValueElement = field.querySelector(".current-value");

                function hideElements(...elements) {
                    elements.forEach(element => element.style.display = "none");
                }

                function showElements(...elements) {
                    elements.forEach(element => element.style.display = "block");
                }

                hideElements(inputElement, saveBtn, closeBtn);


                editBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    openEditState();
                });

                closeBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    closeEditState();
                });

                saveBtn.addEventListener("click", (e) => {
                    e.stopPropagation()
                    hideElements(inputElement, saveBtn, closeBtn);
                    showElements(currentValueElement, editBtn);
                    currentValueElement.innerText = inputElement.value;
                    field.setAttribute("data-focused", false);
                });

                function openEditState() {
                    closePrevious();
                    hideElements(currentValueElement, editBtn);
                    showElements(inputElement, saveBtn, closeBtn);
                    inputElement.value = currentValueElement.innerText;
                    inputElement.focus();
                    field.setAttribute("data-focused", true);
                };

                function closeEditState() {
                    hideElements(inputElement, saveBtn, closeBtn);
                    showElements(currentValueElement, editBtn);
                    inputElement.value = "";
                    field.setAttribute("data-focused", false);
                };

                function closePrevious() {
                    const activeField = document.querySelector(".field-custom[data-focused='true']");
                    if (activeField && activeField !== field) {
                        hideElements(
                            activeField.querySelector("input"),
                            activeField.querySelector(".save-btn"),
                            activeField.querySelector(".close-btn")
                        );
                        showElements(
                            activeField.querySelector(".current-value"),
                            activeField.querySelector(".edit-btn")
                        );
                        activeField.querySelector("input").value = "";
                        activeField.setAttribute("data-focused", "false");
                    }
                }

            })
        }
    })




    // Form Steps Logic Starts 

    const formSections = document.querySelectorAll(".form-sec");
    const successMessageSec = document.querySelector(".successMessageSec");


    formSections.forEach((formSection, sectionIndex) => {
        const selectExistingForm = document.getElementById("selectExisting");
        const createEntityForm = document.getElementById("createEntity");
        const vendorDetailsForm = document.getElementById("vendorDetails");
        const createNewEntityBtn = document.getElementById("createNewEntityBtn");


        const sectionId = formSection.getAttribute("id");
        const stepIndicators = formSection.querySelectorAll(".steps-list .step-item");
        const stepProgress = formSection.querySelector(".steps-list .step-progress");
        const allForms = formSection.querySelectorAll(".form-body");

        const totalSteps = allForms.length;


        let currentStep = parseInt(sessionStorage.getItem(`currentFormStep_${sectionId}`)) || 1;
        let subStep = parseInt(sessionStorage.getItem("currentSubStep")) || 1;

        sessionStorage.setItem(`currentFormStep_${sectionId}`, currentStep);

        function updateFormStep(step) {

            if (sectionId == "createAccountSec") {
                if (step > totalSteps) {
                    successMessageSec.style.display = "block";
                    successMessageSec.style.visibility = "visible";
                    formSection.style.display = "none";
                    formSection.style.visibility = "hidden";
                }
            }

            if (sectionId == "loginFormSec") {
                if (step > totalSteps) {
                    window.location.replace("create-vendor.html");
                }
            }


            allForms.forEach((formBody, index) => {
                if (step <= totalSteps) {
                    formBody.setAttribute('data-state', (index + 1) === step ? 'true' : 'false');
                }
            });

            updateStepIndicator(step);
            updateStepProgress(step);
        };

        function updateStepIndicator(step) {
            stepIndicators.forEach((indicator, index) => {
                let itemIndex = index + 1;
                if (itemIndex < step) {
                    indicator.classList.add("completed");
                    indicator.classList.remove("active");
                } else if (itemIndex == step) {
                    indicator.classList.add("active");
                } else {
                    indicator.classList.remove("completed", "active");
                }
                if (step > totalSteps) {
                    indicator.classList.add("completed");
                    indicator.classList.remove("active");
                }
            });
        };

        function updateStepProgress(step) {
            if (step <= totalSteps) {
                if (stepProgress) {
                    let progressWidth = ((step - 1) / (totalSteps - 1)) * 100;
                    stepProgress.style.width = `${progressWidth}%`;
                }
            }
        };


        function loadSavedFormData(input, formDataObject) {
            const savedValue = formDataObject[input.name];
            if (savedValue) {
                if (input.type !== 'file') {
                    if (input.type == 'checkbox' || input.type == 'radio') {
                        if (input.value == savedValue) {
                            input.checked = true;
                        }
                    } else {
                        input.value = savedValue;
                    }
                }
            }
        };

        function updateFormVisibility() {
            if (createNewEntityBtn) {
                selectExistingForm.style.display = subStep === 1 ? "flex" : "none";
                createEntityForm.style.display = subStep === 2 ? "flex" : "none";
                vendorDetailsForm.style.display = subStep === 3 ? "flex" : "none";
            }
        }

        updateFormVisibility();

        if (createNewEntityBtn) {
            createNewEntityBtn.addEventListener("click", function () {
                subStep = 2;
                updateFormVisibility();
            });
        }


        allForms.forEach((formBody) => {
            const forms = formBody.querySelectorAll("form");

            forms.forEach((form) => {
                const backBtn = form.querySelector('.form-prev-btn');
                const formBtn = form.querySelector('button[type="submit"]');
                if (formBtn) {
                    formBtn.disabled = true;
                }
                const inputs = form.querySelectorAll('input, select, textarea');
                const formId = form.getAttribute("id");
                const formKey = `${formId}Data`;

                if (formId && !["createEntity", "vendorDetails", "selectExisting"].includes(formId)) {
                    const savedFormData = sessionStorage.getItem(formKey);
                    form.addEventListener("reset", () => {
                        if (savedFormData) sessionStorage.removeItem(formKey);
                    });
                    if (savedFormData) {
                        const formDataObject = JSON.parse(savedFormData);
                        inputs.forEach(input => loadSavedFormData(input, formDataObject));
                    }
                    inputs.forEach(input => {
                        if (input.type === "password") return;
                        const eventType = (input.type === 'radio' || input.type === 'checkbox') ? 'change' : 'input';
                        input.addEventListener(eventType, () => saveToSessionStorage(input, formKey));
                    });
                }

                if (formBtn) {
                    form.addEventListener("input", function (e) {
                        e.preventDefault();

                        if (form.checkValidity()) {
                            formBtn.disabled = false;
                        } else {
                            formBtn.disabled = true;
                        }
                    });

                    form.addEventListener("change", function (e) {
                        e.preventDefault();

                        if (form.checkValidity()) {
                            formBtn.disabled = false;
                        } else {
                            formBtn.disabled = true;
                        }
                    });

                    if (form.checkValidity()) {
                        formBtn.disabled = false;
                    } else {
                        formBtn.disabled = true;
                    }
                }

                if (backBtn) {
                    backBtn.addEventListener('click', function (e) {
                        e.preventDefault();

                        if (currentStep > 1) {
                            currentStep--;
                            updateFormStep(currentStep);
                            sessionStorage.setItem(`currentFormStep_${sectionId}`, currentStep);
                        }
                    });
                }

                form.addEventListener("submit", function (e) {
                    e.preventDefault();

                    if (form.checkValidity()) {
                        if (currentStep <= totalSteps) {

                            if (formId == "createEntity") {
                                subStep = 3;
                                updateFormVisibility();
                            } else {
                                currentStep++;
                                updateFormStep(currentStep);

                                sessionStorage.setItem(`currentFormStep_${sectionId}`, currentStep);

                                if (currentStep > totalSteps) {

                                    sessionStorage.setItem(`currentFormStep_${sectionId}`, "completed");

                                    allForms.forEach(formStep => {
                                        const formToClearId = formStep.querySelector("form").getAttribute("id");
                                        // sessionStorage.removeItem(`${formToClearId}Data_${sectionIndex}`);
                                        sessionStorage.removeItem(`${formToClearId}Data`);
                                    });
                                }
                            }

                        }
                    } else {
                        form.reportValidity();
                    }
                });
            })

        });


        updateFormStep(currentStep);
    });

    function saveToSessionStorage(input, formKey) {
        const currentFormData = JSON.parse(sessionStorage.getItem(formKey)) || {};
        currentFormData[input.name] = input.value;
        sessionStorage.setItem(formKey, JSON.stringify(currentFormData));
    }






















    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})(jQuery);