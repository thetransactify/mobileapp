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
                                <a href="{{url('manage-compliance')}}" >Compliance Status</a>
                            </li>
                            <!-- <li class="tab-item">
                                <a href="./gst-status.html">GST Compliance</a>
                            </li> -->
                            <li class="tab-item">
                                <a href="{{url('document-Attached')}}" class="tab-active">Document Attached</a>
                            </li>
                        </nav>
                    </div>

                    <div class="inner-wrapper">
                        
                        <div class="form-body">
                            <button type="button" class="btn btn-primary button-with-icon mt-0 mb-4 ms-auto" data-bs-toggle="modal" data-bs-target="#addNewFile">
                                <span>Add Document</span>
                                <span class="icon"><i class="fa-light fa-file-arrow-up"></i></span>
                            </button>

                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Documents</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="text-label">PAN</span></td>
                                            <td>
                                                <div class="action-btns-wrapper">
                                                    <span class="action-btn view-icon">
                                                        <i class="fa-regular fa-arrow-down-to-line"></i>
                                                    </span>
                                                    <span class="action-btn view-icon">
                                                        <i class="fa-regular fa-pen-line"></i>
                                                    </span>
                                                    <span class="action-btn trash-icon">
                                                        <i class="fa-regular fa-trash"></i>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                        <div class="modal fade" id="addNewFile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Document</h2>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate>
                       
                            <div class="input-wrapper">
                                <span class="input-title light">Document Name</span>
                                <input type="text" class="form-control" name="newDocName" placeholder="Enter document name" required>
                            </div>
                    
                            <div class="input-wrapper">
                                <div class="upload-box">
                                    <input type="file" class="file-input" accept="image/png, image/jpeg, application/pdf" name="newDocFile" required>
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
                            </div>

                            <button type="submit" class="btn btn-primary"> Save</button>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    
                </div>
            </div>
</section>

@endsection