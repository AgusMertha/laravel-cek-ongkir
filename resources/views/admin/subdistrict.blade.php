<!DOCTYPE html>

<html lang="en" >
    <head>
        <meta charset="utf-8"/>
        <title>Admin | Cek Ongkir App</title>
        <meta name="description" content="Updates and statistics"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
        <link href="/adm/css/plugins.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
        <link href="/adm/css/prismjs.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
        <link href="/adm/css/style.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
        <link href="/users/plugin/select2/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

        <meta name="csrf-token" content="{{csrf_token()}}">
        <style>
            #load {
                position: fixed;
                top: 0;
                z-index: 999999999;
                width: 100%;
                height: 100%;
                display: none;
                background: rgba(0,0,0,0.6);
            }
            
            .cv-load {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .load {
                width: 60px;
                height: 60px;
                border: 4px #ddd solid;
                border-top: 4px #2e93e6 solid;
                border-radius: 50%;
                animation: sp-anime 0.8s infinite linear;
            }
            
            @keyframes sp-anime {
                0% {
                    transform: rotate(0deg);
                }
        
                100% {
                    transform: rotate(359deg);
                }
            }
        </style>
    </head>

    <body  id="kt_body"  class="header-fixed subheader-enabled page-loading"  >
        <div id="load"> 
            <div class="cv-load">
              <span class="load"></span>
            </div>
          </div>
	    <div class="d-flex flex-column flex-root">
		    <div class="d-flex flex-row flex-column-fluid page">
			    <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <div id="kt_header_mobile" class="header-mobile " >
                        <a href="#"><img alt="Logo" src="/images/logo.svg" class="max-h-30px"/></a>
	                    <div class="d-flex align-items-center">

					        <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle"><span></span></button>

		                    <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
			                    <span class="svg-icon svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                    </svg>
                                </span>
                            </button>
	                    </div>
                    </div>

                    <div id="kt_header" class="header  header-fixed" >
	                    <div class=" container ">
		                    <div class="d-none d-lg-flex align-items-center mr-3">
			                    <a href="#" class="mr-20"><img alt="Logo" src="/images/logo.svg" class="logo-default max-h-35px"/></a>
		                    </div>
                        </div>
                    </div>
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <div class=" container ">
                            <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile  header-menu-layout-default header-menu-root-arrow " >
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a  href="{{route("admin.index")}}" class="menu-link">
                                            <span class="menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a  href="{{route("admin.province")}}" class="menu-link">
                                            <span class="menu-text">Data Provinsi</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a  href="{{route("admin.city")}}" class="menu-link">
                                            <span class="menu-text">Data Kota / Kabupaten</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel menu-item-open menu-item-here">
                                        <a  href="{{route("admin.subdistrict")}}" class="menu-link">
                                            <span class="menu-text">Data Kecamatan</span>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu menu-item-rel">
                                        <a  href="{{route("admin.courier")}}" class="menu-link">
                                            <span class="menu-text">Data Kurir</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
	                <div class="d-flex flex-row flex-column-fluid  container ">
		                <div class="main d-flex flex-column flex-row-fluid">
		                    <div class="content flex-column-fluid">
                                <div class="col-lg-12">
                                    <div class="card card-custom">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Tambah data provinsi</h3>
                                        </div>
                                    </div>
                                        <div class="card-body">
                                            <form action="" id="form_subdistrict" method="post">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <select name="city" id="select_city" class="form-control" placeholder="pilih kota">
                                                              
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <select name="subdistrict" id="select_subdistrict" class="form-control" disabled placeholder="pilih Kecamatan">
                                                              
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-5">
                                    <div class="card card-custom">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Data Kota / Kabupaten</h3>
                                        </div>
                                    </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="subdistrict-table" class="display table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Provinsi</th>
                                                            <th>Nama Kota / Kabupaten</th>
                                                            <th>Kecamatan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                          <th>#</th>
                                                          <th>Nama Provinsi</th>
                                                          <th>Nama Kota / Kabupaten</th>
                                                          <th>Kecamatan</th>
                                                          <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="footer py-4 d-flex flex-lg-column " id="kt_footer">
	                    <div class=" container  d-flex flex-column flex-md-row align-items-center justify-content-between">
                      </div>
                    </div>
			    </div>
		    </div>
	    </div>

        <script src="/adm/js/plugins.bundle.js?v=7.0.6"></script>
        <script href="/adm/js/prismjs.bundle.js?v=7.0.6"></script>
        <script src="/adm/js/scripts.bundle.js?v=7.0.6"></script>
        <script src="/users/plugin/select2/select2.min.js"></script>
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/adm/js/subdistrict.js"></script>
    </body>
</html>
