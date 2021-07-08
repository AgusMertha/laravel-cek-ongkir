<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/users/plugin/select2/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/users/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/users/css/main.css" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Tracing Express</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="images/logo.svg" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-md-4">
              <a id="link-cek-resi" class="nav-link active" href="#">Cek Resi</a>
            </li>
            <li class="nav-item mx-md-4">
              <a id="link-cek-ongkir" class="nav-link" href="#">Cek Ongkir</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="wrap-heading-contain" id="heading-contain">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 wrap-img-heading mb-5">
            <img src="images/il-home.svg" alt="" />
          </div>
          <div class="col-md-6 wrap-content-heading mb-5">
            <div class="content-heading">
              <h2>Tracking Express</h2>
              <p>
                kami menghadirkan layanan <br />
                realtime tracking system
              </p>
            </div>
            <div>
              <a id="start-now" class="btn btn-start-now" href="">Mulai Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div id="main-page" class="container wrap-main-contain-resi main-page cek-resi">
        <div class="row">
          <div class="col-12">
            <h3>Lacak Pengiriman</h3>
            <p>lacak pengiriman anda dengan mudah dan cepat</p>
            <form method="post" action="{{route("waybill")}}" id="form_waybill">
              @csrf
              <div class="row mt-4">
                <div class="col">
                  <div class="form-group">
                    <input type="text" class="form-control" name="waybill" id="waybill" placeholder="Input no resi pengiriman anda"/>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group select2">
                    <select name="courier" id="courier" class="form-control">
                      <option value="jne">JNE</option>
                      <option value="jnt">JNT</option>
                      <option value="sicepat">SI CEPAT</option>
                      <option value="pos">POS</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2">
                  <button class="btn btn-search-resi">
                    <img src="images/ic-search.svg" alt="" />
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-12">
            <class class="wrap-contain-lacak-table"> 
              <div id="loader">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
              </div>
              <div id="waybill_content">
                <h2 id="courier_name"></h2>
                <h6 class="mt-4 font-weight-bold">Informasi Pengiriman</h6>
                <table class="table table-border">
                  <thead>
                    <tr>
                      <th scope="col">No Resi</th>
                      <th scope="col">Status</th>
                      <th scope="col">Pengirim</th>
                      <th scope="col">Penerima</th>
                    </tr>
                  </thead>
                  <tbody id="waybill_table_body">
                    
                  </tbody>
                </table>

                <h6 class="mt-5 font-weight-bold">Informasi Detail</h6>
                <table class="table table-border">
                  <thead>
                    <tr>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Lokasi</th>
                      <th scope="col">Description</th>
                    </tr>
                  </thead>
                  <tbody id="waybill_detail_table_body">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section>
        <div class="container wrap-main-contain-ongkir cek-ongkir">
          <div class="row">
            <div class="col-12">
              <h3>Cek Ongkir</h3>
              <p>cek pengiriman anda dengan mudah dan cepat</p>
              <form action="">
                <div class="row mt-4">
                    <div class="col">
                        <div class="form-group" >
                          <select name="" id="" class="form-control js-example-basic-multiple">
                            <option>Kota asal pengiriman</option>
                            <option value="">Jakarta</option>
                            <option value="">Yogyakarta</option>
                            <option value="">Denpasar</option>
                          </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <select name="" id="" class="form-control js-example-basic-multiple">
                            <option>Kota tujuan pengiriman</option>
                            <option value="">Jakarta</option>
                            <option value="">Yogyakarta</option>
                            <option value="">Denpasar</option>
                          </select>
                        </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <select name="" id="" class="form-control select2 js-example-basic-multiple">
                        <option>Kota tujuan pengiriman</option>
                        <option value="">Jakarta</option>
                        <option value="">Yogyakarta</option>
                        <option value="">Denpasar</option>
                      </select>
                    </div>
                    </div>
                    <div class="col">
                    <button class="btn btn-search-resi">
                      <img src="images/ic-search.svg" alt="" />
                    </button>
                    </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div>
                      <div class="lds-ring" style="position: relative; left: 50%;right: auto"><div></div><div></div><div></div><div></div></div>
                    </div>
                    <label for="">
                      <h3>JNE</h3>
                      <p>Jalur nugraha ekakurir</p>
                    </label>
                    <table class="table table-borderless rounded"  style="border: 1px solid #D9D9D9; border-radius: 1rem !important;">
                      <thead>
                        <tr>
                          <th scope="col">Service</th>
                          <th scope="col">Estimasi</th>
                          <th scope="col">Tarif</th>
                          <th scope="col">Deskripsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>JNE OK</td>
                          <td>4-5 hari</td>
                          <td>Rp. 14,000</td>
                          <td>ongkos kirim ekonomis</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>

      <footer>
            <div class="img-footer">
              <img src="images/footer-logo.svg" alt="">
            </div>
      </footer>

    <script src="/users/js/jquery-3.6.0.min.js"></script>
    <script src="/users/plugin/select2/select2.min.js"></script>
    <script src="/users/js/bootstrap.min.js"></script>
    <script src="/users/js/main.js"></script>

    <script>
      function smoothScroll(target, duration) {
      var target = document.querySelector(target);
      var targetPosition = target.getBoundingClientRect().top;
      var startPosition = window.pageYOffset;
      var distance = targetPosition - startPosition;
      var startTime = null;

      function animation(currentTime) {
          if (startTime === null) startTime = currentTime;
          var timeElapsed = currentTime - startTime;
          var run = ease(timeElapsed, startPosition, distance, duration);
          window.scrollTo(0, run);
          if (timeElapsed < duration) requestAnimationFrame(animation);
      }

      function ease(t, b, c, d) {
          t /= d / 2;
          if(t < 1) return c / 2 * t * t + b;
          t--;
          return -c / 2 * (t * (t - 2) - 1) + b;
      }

      requestAnimationFrame(animation);
  }

    var section1 = document.querySelector('#link-cek-resi')

    section1.addEventListener('click', function() {
        smoothScroll('.cek-resi', 1000);
    })

    var section2 = document.querySelector('#link-cek-ongkir')

    section2.addEventListener('click', function() {
        smoothScroll('.cek-ongkir', 1000);
    })

    var section3 = document.querySelector('#start-now')

    section3.addEventListener('click', function() {
        smoothScroll('.cek-ongkir', 1000);
    })
 
    </script>

    <script>
      $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
      });
    </script>
   
  </body>
</html>
