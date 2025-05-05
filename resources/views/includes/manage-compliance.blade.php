@extends('layouts.app')
<title>@yield('title', 'Manage-profile')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
 <section class="form-sec">
            <div class="container">
                <div class="text-left">
                    <h2 class="form-title">Welcome to <b>@yield('title', 'Manage-profile')</b></h2>
                </div>

                <div class="form-container">
                    <div class="form-navigation">
                        <nav>
                            <li class="tab-item">
                                <a href="{{url('manage-profile')}}">Overview</a>
                            </li>
                            <li class="tab-item">
                                <a href="{{url('manage-compliance')}}" class="tab-active">Compliance Status</a>
                            </li>
                            <!-- <li class="tab-item">
                                <a href="./gst-status.html">GST Compliance</a>
                            </li> -->
                            <li class="tab-item">
                                <a href="{{url('document-Attached')}}">Document Attached</a>
                            </li>
                        </nav>
                    </div>

                                       <div class="inner-wrapper">
                        <div class="form-body">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Compliance Type</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="text-label">PAN</span></td>
                                            <td>
                                                <span class="view-icon" data-bs-toggle="modal"
                                                    data-bs-target="#viewPanCard" onclick="showPanModal({{ $user_id }})">
                                                    <i class="fa-regular fa-eye"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-label">MSME</span></td>
                                            <td>
                                                <span class="view-icon" data-bs-toggle="modal"
                                                    data-bs-target="#viewMSME" onclick="showMSME({{ $user_id }})"><i class="fa-regular fa-eye"></i></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-label"> Bank Account </span></td>
                                            <td>
                                                <span class="view-icon" data-bs-toggle="modal"
                                                    data-bs-target="#viewBank" onclick="showBankModal({{ $user_id }})">
                                                    <i class="fa-regular fa-eye"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                        <div class="modal fade" id="viewPanCard" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Pan Card</h2>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="input-wrapper">
                            <div class="upload-box" data-saved-file="/assets/images/PAN.png">
                                <input type="file" id="panCard" class="file-input"
                                    accept="image/png, image/jpeg, application/pdf" name="pan" />

                                <span class="drop-text">
                                    <i class="bi bi-cloud-upload"></i>
                                    <p>
                                        Drop file to Attach, or
                                        <span class="browse-text">browse</span>
                                    </p>
                                </span>

                                <div class="preview-container">
                                    <canvas class="preview-canvas"></canvas>
                                    <div id="file-info" class="file-info">
                                        <span class="file-name"></span>
                                        <span class="file-size"></span>
                                    </div>

                                    <button class="remove-file-btn" onclick="Panremove({{ $user_id }})" type="button">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrapper field-custom">
                            <label for="panInput">PAN:</label>
                            <span class="current-value"></span>
                            <input type="text" name="panInput" id="panInput">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn" onclick="savePan('{{ ($user_id) }}')" type="button"></button>
                            </div>
                        </div>
                        
                        <div class="input-wrapper field-custom">
                            <label for="panDOB">Date of Birth on PAN:</label>
                            <span class="current-value"></span>
                            <input type="text" name="panDOB" id="panDOB">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn"  onclick="savePan('{{ ($user_id) }}')" type="button"></button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewBank" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Bank Account</h2>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="input-wrapper">
                            <span class="input-title light">Copy of cancelled cheque</span>
                            <div class="upload-box" data-saved-file="/assets/images/cancelled_cheque.jpg">
                                <input type="file" id="cancelledChequefile" class="file-input"
                                    accept="image/png, image/jpeg, application/pdf" name="pan" />

                                <span class="drop-text">
                                    <i class="bi bi-cloud-upload"></i>
                                    <p>
                                        Drop file to Attach, or
                                        <span class="browse-text">browse</span>
                                    </p>
                                </span>

                                <div class="preview-container">
                                    <canvas class="preview-canvas"></canvas>
                                    <div id="file-info" class="file-info">
                                        <span class="file-name"></span>
                                        <span class="file-size"></span>
                                    </div>

                                    <button class="remove-file-btn" type="button" onclick="Bankremove({{ $user_id }})">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="input-wrapper field-custom">
                            <label for="bankName">Bank Name:</label>
                            <span class="current-value"></span>
                            <input type="text" name="bankName" id="bankName">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn"  onclick="saveBank('{{ ($user_id) }}')" type="button"></button>
                            </div>
                        </div>
                        
                        <div class="input-wrapper field-custom">
                            <label for="bankAC">Ac. Number:</label>
                            <span class="current-value"></span>
                            <input type="text" name="bankAC" id="bankAC">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn" onclick="saveBank('{{ ($user_id) }}')" type="button"></button>
                            </div>
                        </div>
                        
                        <div class="input-wrapper field-custom">
                            <label for="bankIFSC">Bank IFSC:</label>
                            <span class="current-value"></span>
                            <input type="text" name="bankIFSC" id="bankIFSC">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn" onclick="saveBank('{{ ($user_id) }}')" type="button"></button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="viewMSME" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">MSME</h2>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="input-wrapper">
                            <div class="upload-box">
                                <input type="file" id="MSMEfile" class="file-input"
                                    accept="image/png, image/jpeg, application/pdf" name="pan" />

                                <span class="drop-text">
                                    <i class="bi bi-cloud-upload"></i>
                                    <p>
                                        Drop file to Attach, or
                                        <span class="browse-text">browse</span>
                                    </p>
                                </span>

                                <div class="preview-container">
                                    <canvas class="preview-canvas"></canvas>
                                    <div id="file-info" class="file-info">
                                        <span class="file-name"></span>
                                        <span class="file-size"></span>
                                    </div>

                                    <button class="remove-file-btn" type="button" onclick="removeMSME({{ ($user_id) }})">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="input-wrapper field-custom">
                            <label for="MSMSE-no">MSMSE Registration Number:</label>
                            <span class="current-value"></span>
                            <input type="text" name="MSMSE-no" id="MSMSE-no">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn" type="button" onclick="saveMSME('{{ ($user_id) }}')"></button>
                            </div>
                        </div>
                        
                        <div class="input-wrapper field-custom">
                            <label for="cr-period">Credit Period:</label>
                            <span class="current-value"></span>
                            <input type="text" name="cr-period" id="cr-period">
                            <div class="btns-wrapper">
                                <button class="edit-btn" type="button"></button>
                                <button class="close-btn" type="button"></button>
                                <button class="save-btn" type="button" onclick="saveMSME('{{ ($user_id) }}')"></button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
</section>
<script type="text/javascript">
    function showPanModal(userId) {
       // alert(userId);
    $.ajax({
        url: '/pan-details/' + userId,
        method: 'GET',
        success: function (data) {
            // Set PAN
            $('#panInput').val(data.pan);
            $('#viewPanCard .field-custom .current-value').eq(0).text(data.pan);

            // Set DOB
            $('#panDOB').val(data.dob);
            $('#viewPanCard .field-custom .current-value').eq(1).text(data.dob);

            // Preview PAN file
            let fileExtension = data.file_path.split('.').pop().toLowerCase();
            let previewContainer = $('.preview-container');
            let canvas = previewContainer.find('.preview-canvas')[0];

            if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'jpeg') {
                let ctx = canvas.getContext('2d');
                let img = new Image();
                img.onload = function () {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);
                };
                img.src = data.file_path;
            } else {
                // Handle PDF or other formats
                previewContainer.html('<p>PDF file uploaded: ' + data.file_path + '</p>');
            }

            // Show modal
            $('#viewPanCard').modal('show');
        }
    });
}

function showBankModal(encryptedUserId) {
    $.ajax({
        url: '/Bank-details/' + encryptedUserId,
        method: 'GET',
        success: function (data) {
            // Set field values
            $('#bankName').val(data.bank_name);
            $('#viewBank .field-custom .current-value').eq(0).text(data.bank_name);

            $('#bankAC').val(data.account_number);
            $('#viewBank .field-custom .current-value').eq(1).text(data.account_number);

            $('#bankIFSC').val(data.ifsc);
            $('#viewBank .field-custom .current-value').eq(2).text(data.ifsc);

            // File preview
            let fileExt = data.cancelled_cheque.split('.').pop().toLowerCase();
            let previewContainer = $('#viewBank .preview-container');
            let canvas = previewContainer.find('.preview-canvas')[0];

            if (fileExt === 'jpg' || fileExt === 'jpeg' || fileExt === 'png') {
                let img = new Image();
                img.onload = function () {
                    const ctx = canvas.getContext('2d');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                };
                img.src = data.cancelled_cheque;
            } else {
                previewContainer.html(`<p>File uploaded: <a href="${data.cancelled_cheque}" target="_blank">View</a></p>`);
            }

            // Show modal
            $('#viewBank').modal('show');
        },
        error: function (xhr) {
            alert('Failed to fetch bank details');
        }
    });
}

function Panremove(encryptedUserId) {
    if (!confirm('Are you sure you want to remove PAN details?')) return;

    // alert("hii");

    $.ajax({
        url: '/remove-pan-details/' + encryptedUserId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (res) {
            alert('PAN details removed successfully');
            // Clear modal fields
            $('#panInput').val('');
            $('#panDOB').val('');
            $('.current-value').eq(0).text('');
            $('.current-value').eq(1).text('');
            $('.preview-container').hide();
        },
        error: function () {
            alert('Failed to remove PAN details');
        }
    });
}
function savePan(encryptedUserId) {
    let pan = $('#panInput').val();
    let dob = $('#panDOB').val();

    $.ajax({
        url: '/save-pan-details/' + encryptedUserId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            pan_number: pan,
            pan_dob: dob
        },
        success: function (res) {
            alert('PAN details updated!');
            $('.current-value').eq(0).text(pan);
            $('.current-value').eq(1).text(dob);
        },
        error: function () {
            alert('Failed to update PAN details.');
        }
    });
}

function Bankremove(encryptedUserId) {
    if (!confirm('Are you sure you want to remove Bank details?')) return;
    $.ajax({
        url: '/remove-bank-details/' + encryptedUserId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (res) {
            alert('Bank details removed successfully');
            // Clear modal fields
           $('#bankName').val('');
            $('#bankAC').val('');
            $('#bankIFSC').val('');

            // Clear current-value display
            $('#bankName').closest('.field-custom').find('.current-value').text('');
            $('#bankAC').closest('.field-custom').find('.current-value').text('');
            $('#bankIFSC').closest('.field-custom').find('.current-value').text('');

            // Reset file input and preview
            $('#cancelledChequefile').val('');
            $('.preview-container').hide();
            $('.file-name').text('');
            $('.file-size').text('');
        },
        error: function () {
            alert('Failed to remove Bank details');
        }
    });
}
function saveBank(encryptedUserId) {
    let bankName = $('#bankName').val().trim();
    let accountNumber = $('#bankAC').val().trim();
    let ifsc = $('#bankIFSC').val().trim();

    $.ajax({
        url: '/save-bank-details/' + encryptedUserId,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            bank_name: bankName,
            bank_account: accountNumber,
            bank_ifsc: ifsc
        },
        success: function (res) {
            alert('Bank details updated.');

            $('#bankName').closest('.field-custom').find('.current-value').text(bankName);
            $('#bankAC').closest('.field-custom').find('.current-value').text(accountNumber);
            $('#bankIFSC').closest('.field-custom').find('.current-value').text(ifsc);
        },
        error: function (xhr) {
            let errorMsg = xhr.responseJSON?.message || 'Failed to update bank details.';
            alert(' ' + errorMsg);
        }
    });
}

function showMSME(userId) {
    $.ajax({
        url: '/msme-details/' + userId, 
        method: 'GET',
        success: function (data) {
            $('#MSMSE-no').val(data.msme_no);
            $('#viewMSME .field-custom .current-value').eq(0).text(data.msme_no);

            $('#cr-period').val(data.credit_period);
            $('#viewMSME .field-custom .current-value').eq(1).text(data.credit_period);

            let fileExtension = data.file_path.split('.').pop().toLowerCase();
            let previewContainer = $('#viewMSME .preview-container');
            let canvas = previewContainer.find('.preview-canvas')[0];

            if (fileExtension === 'png' || fileExtension === 'jpg' || fileExtension === 'jpeg') {
                let ctx = canvas.getContext('2d');
                let img = new Image();
                img.onload = function () {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);
                };
                img.src = data.file_path;
            } else if (fileExtension === 'pdf') {
                previewContainer.html('<p>PDF file uploaded: <a href="' + data.file_path + '" target="_blank">View PDF</a></p>');
            } else {

                previewContainer.html('<p>Unsupported file format.</p>');
            }

            $('#viewMSME').modal('show');
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            alert('Failed to load MSME details.');
        }
    });
}
function removeMSME(encryptedUserId) {
    if (!confirm('Are you sure you want to remove MSME details?')) return;

    $.ajax({
        url: '/remove-msme-details/' + encryptedUserId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function (res) {
            alert('MSME details removed successfully');
            // Clear modal fields
            $('#MSMSE-no').val('');
            $('#cr-period').val('');
            $('#viewMSME .field-custom .current-value').eq(0).text('');
            $('#viewMSME .field-custom .current-value').eq(1).text('');
            $('#viewMSME .preview-container').hide();
        },
        error: function () {
            alert('Failed to remove MSME details');
        }
    });
}
function saveMSME(encryptedUserId) {
    let msmeNo = $('#MSMSE-no').val();
    let creditPeriod = $('#cr-period').val();

    $.ajax({
        url: '/save-msme-details/' + encryptedUserId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            msme_no: msmeNo,
            credit_period: creditPeriod
        },
        success: function (res) {
            alert('MSME details updated!');
            $('#viewMSME .field-custom .current-value').eq(0).text(msmeNo);
            $('#viewMSME .field-custom .current-value').eq(1).text(creditPeriod);
        },
        error: function () {
            alert('Failed to update MSME details.');
        }
    });
}

</script>
@endsection