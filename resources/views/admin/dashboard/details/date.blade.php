<div class="col-lg-12 col-md-12 col-sm-12 my-3">
    <div class="card bg-analytics text-white">
        <div class="card-content">
            <div class="card-body text-center">
                <div class="avatar avatar-xl bg-primary shadow mt-0" style="margin: 0 auto; border-radius: 50%;">
                    <div class="avatar-content
                        d-flex justify-content-center align-items-center w-100 h-100">
                        <i class="fa fa-image"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="mb-2">{{ \Carbon\Carbon::now()->translatedFormat('l j F Y') }}</h1>
                    <p class="m-auto w-75" style="color: black">{{ $dataHijri }}</p>
                    <hr>
                    <p class="m-0 dashboard-clock-now text-center" style="font-size: 20px; color: black"></p>
                </div>
            </div>
        </div>
    </div>
</div>
