@extends('layouts.main')

@section('title', 'Beranda - Catering Nizam Al Berkah')

@section('content')
<section class="hero-wrap">
		<div class="home-slider owl-carousel js-fullheight">
			<div class="slider-item js-fullheight" style="background-image:url(images/bg.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 mt-5 text-center">
								<span class="subheading">Catering Nizam</h2></span>
								<h1>Al Berkah NAB</h1>
								<span class="subheading-2">2024</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight" style="background-image:url(images/bg2.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-12 ftco-animate">
							<div class="text w-100 mt-5 text-center">
								<span class="subheading">Catering Nizam Al Berkah</h2></span>
								<h1>Best Quality</h1>
								<span class="subheading-2 sub">Makanan</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="ftco-section ftco-wrap-about ftco-no-pb ftco-no-pt">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-sm-4 p-4 p-md-5 d-flex align-items-center justify-content-center bg-primary">
					<!-- <form action="#" class="appointment-form">
						<h3 class="mb-3">Book your Table</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="name" class="form-control" placeholder="Name">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Email">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Phone">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="input-wrap">
										<div class="icon"><span class="fa fa-calendar"></span></div>
										<input type="text" class="form-control book_date" placeholder="Check-In">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="input-wrap">
										<div class="icon"><span class="fa fa-clock-o"></span></div>
										<input type="text" class="form-control book_time" placeholder="Time">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="form-field">
										<div class="select-wrap">
											<div class="icon"><span class="fa fa-chevron-down"></span></div>
											<select name="" id="" class="form-control">
												<option value="">Guest</option>
												<option value="">1</option>
												<option value="">2</option>
												<option value="">3</option>
												<option value="">4</option>
												<option value="">5</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Book Your Table Now" class="btn btn-white py-3 px-4">
								</div>
							</div>
						</div>
					</form> -->
				</div>
				<div class="col-sm-8 wrap-about py-5 ftco-animate img" style="background-image: url(images/about.jpg);">
					<div class="row pb-5 pb-md-0">
						<div class="col-md-12 col-lg-7">
							<div class="heading-section mt-5 mb-4">
								<div class="pl-lg-3 ml-md-5">
									<span class="subheading">Tentang</span>
									<h2 class="mb-4">Selamat Datang di Catering Nizam Al Berkah</h2>
								</div>
							</div>
							<div class="pl-lg-3 ml-md-5">
								<p>Ketika bercita-cita untuk menawarkan layanan terbaik dalam perjalanan itu, Catering Nizam Al Berkah mengalami tantangan besar. Terutama, pengalaman itu berbicara tentang apa yang seharusnya menjadi prioritas; bahwa adalah keharusan untuk menjaga kualitas dan kepuasan pelanggan. Makanan, kami diingatkan, akan menjadi santapan yang diawali oleh “dan,” jika kami tidak lagi memprioritaskan kebutuhan krees terhadap kualitas. Tentu saja, kami, bergerak cepat dengan misi kami, selalu harus kembali ke arah mana aliran sungai layanan superior itu bersumber.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-intro" style="background-image: url(images/bg_3.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<span>Catering Pemesanan Sekarang</span>
					<h2>Ada Menu Spesial &amp; Happy Enjoyy</h2>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Spesialisasi</span>
					<h2 class="mb-4">Menu Kami</h2>
				</div>
			</div>
			<div class="row">
                <div class="container">
                    <div class="row">
                        @foreach($menus as $menu)
                        <div class="col-md-6 col-lg-4">
                            <div class="menu-wrap hover-effect"> <!-- Tambahkan kelas hover-effect -->
                                <!-- Heading Menu -->
                                <div class="heading-menu text-center ftco-animate">
                                    <h3>{{ $menu->nama }}</h3>
                                </div>
                                <div class="menus d-flex ftco-animate">
                                    <!-- Gambar Menu (background image) -->
                                    <div class="menu-img img" style="background-image: url({{ asset('storage/' . $menu->gambar) }});"></div>
                                    <div class="text">
                                        <div class="d-flex justify-content-between align-items-center">
                                        </div>
                                        <!-- Rincian Menu -->
                                        <h5 class="mt-12 mb-2">Rincian Menu</h5>
                                        <p><span>{{ $menu->deskripsi }}</span></p>

                                        <!-- Harga -->
                                        <div class="one-forth">
                                            <span class="price mb-2 d-block" style="white-space: nowrap;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


						{{-- <div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/breakfast-2.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus border-bottom-0 d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/breakfast-3.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<span class="flat flaticon-bread" style="left: 0;"></span>
						<span class="flat flaticon-breakfast" style="right: 0;"></span>
					</div>
				</div> --}}

				{{-- <div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Lunch</h3>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/lunch-1.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/lunch-2.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus border-bottom-0 d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/lunch-3.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<span class="flat flaticon-pizza" style="left: 0;"></span>
						<span class="flat flaticon-chicken" style="right: 0;"></span>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Dinner</h3>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/dinner-1.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/dinner-2.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus border-bottom-0 d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/dinner-3.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<span class="flat flaticon-omelette" style="left: 0;"></span>
						<span class="flat flaticon-burger" style="right: 0;"></span>
					</div>
				</div>

				<!--  -->
				<div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Desserts</h3>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/dessert-1.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/dessert-2.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus border-bottom-0 d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/dessert-3.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<span class="flat flaticon-cupcake" style="left: 0;"></span>
						<span class="flat flaticon-ice-cream" style="right: 0;"></span>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Wine Card</h3>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/wine-1.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/wine-2.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus border-bottom-0 d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/wine-3.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<span class="flat flaticon-wine" style="left: 0;"></span>
						<span class="flat flaticon-wine-1" style="right: 0;"></span>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="menu-wrap">
						<div class="heading-menu text-center ftco-animate">
							<h3>Drinks &amp; Tea</h3>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/drink-1.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/drink-2.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<div class="menus border-bottom-0 d-flex ftco-animate">
							<div class="menu-img img" style="background-image: url(images/drink-3.jpg);"></div>
							<div class="text">
								<div class="d-flex">
									<div class="one-half">
										<h3>Beef Roast Source</h3>
									</div>
									<div class="one-forth">
										<span class="price">$29</span>
									</div>
								</div>
								<p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span></p>
							</div>
						</div>
						<span class="flat flaticon-wine" style="left: 0;"></span>
						<span class="flat flaticon-wine-1" style="right: 0;"></span>
					</div>
				</div> --}}
			</div>
		</div>

	</section>

	<section class="ftco-section testimony-section" style="background-image: url(images/bg3.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center mb-3 pb-2">
				<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
					<span class="subheading">Testimoni</span>
					<h2 class="mb-4">Testimoni Pelanggan Setia Kami</h2>
				</div>
			</div>
			<div class="row ftco-animate justify-content-center">
				<div class="col-md-7">
					<div class="carousel-testimony owl-carousel ftco-owl">
                        @if($testimoni->isEmpty())
                        <div class="text-center">
                            <p class="text-white">Saat ini belum ada testimoni yang ditambahkan.</p>
                        </div>
                    @else
                        @foreach($testimoni as $testimoni)
                            <div class="item">
                                <div class="testimony-wrap text-center">
                                    <div class="text p-3">
                                        <p class="mb-4">{{ $testimoni->testimonial }}</p>
                                        <div class="user-img mb-4" style="background-image: url('{{ asset('storage/' . $testimoni->image) }}')">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="fa fa-quote-left"></i>
                                            </span>
                                        </div>
                                        <p class="name">{{ $testimoni->name }}</p>
                                        <span class="position">{{ $testimoni->position }}</span>
                                        <div class="star-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="fa fa-star {{ $i <= $testimoni->rating ? 'checked' : '' }}"></span>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Chef</span>
					<h2 class="mb-4">Master Chef Kami</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img" style="background-image: url(images/chef-4.jpg);"></div>
						<div class="text px-4 pt-2">
							<h3>John Gustavo</h3>
							<span class="position mb-2">CEO, Co Founder</span>
							<div class="faded">
								<p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
								<ul class="ftco-social d-flex">
									<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img" style="background-image: url(images/chef-2.jpg);"></div>
						<div class="text px-4 pt-2">
							<h3>Michelle Fraulen</h3>
							<span class="position mb-2">Head Chef</span>
							<div class="faded">
								<p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
								<ul class="ftco-social d-flex">
									<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img" style="background-image: url(images/chef-3.jpg);"></div>
						<div class="text px-4 pt-2">
							<h3>Alfred Smith</h3>
							<span class="position mb-2">Chef Cook</span>
							<div class="faded">
								<p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
								<ul class="ftco-social d-flex">
									<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img" style="background-image: url(images/chef-1.jpg);"></div>
						<div class="text px-4 pt-2">
							<h3>Antonio Santibanez</h3>
							<span class="position mb-2">Chef Cook</span>
							<div class="faded">
								<p>I am an ambitious workaholic, but apart from that, pretty simple person.</p>
								<ul class="ftco-social d-flex">
									<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb">
		<div class="container">
			<div class="row d-flex">
				<div class="col-md-6 d-flex">
					<div class="img img-2 w-100 mr-md-2" style="background-image: url(images/bg_6.jpg);"></div>
					<div class="img img-2 w-100 ml-md-2" style="background-image: url(images/bg_4.jpg);"></div>
				</div>
				<div class="col-md-6 ftco-animate makereservation p-4 p-md-5">
					<div class="heading-section ftco-animate mb-5">
						<span class="subheading">Ini adalah Rahasia Kami</span>
						<h2 class="mb-4">Bahan-Bahan yang Sempurna</h2>
						<p>Jauh di balik keramaian kota, tersembunyi kelezatan khas yang diracik dengan cinta dan kesempurnaan. Di balik setiap hidangan Catering Nizam Al Berkah, kami menggunakan bahan-bahan terbaik yang dipilih dengan teliti, memberikan pengalaman kuliner yang luar biasa. Dengan perpaduan cita rasa otentik dan inovasi modern, kami menciptakan hidangan yang tak hanya memanjakan lidah, tetapi juga meninggalkan kesan yang mendalam di hati. Terinspirasi dari kearifan lokal dan sentuhan kehangatan keluarga, setiap sajian kami adalah persembahan terbaik untuk momen spesial Anda.
						</p>
						<p><a href="#" class="btn btn-primary">Pelajari Selengkapnya</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Blog</span>
					<h2 class="mb-4">Blog Terbaru</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 ftco-animate">
					<div class="blog-entry">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
						</a>
						<div class="text px-4 pt-3 pb-4">
							<div class="meta">
								<div><a href="#">August 3, 2020</a></div>
								<div><a href="#">Admin</a></div>
							</div>
							<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
							<p class="clearfix">
								<a href="#" class="float-left read btn btn-primary">Read more</a>
								<a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="blog-entry">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
						</a>
						<div class="text px-4 pt-3 pb-4">
							<div class="meta">
								<div><a href="#">August 3, 2020</a></div>
								<div><a href="#">Admin</a></div>
							</div>
							<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
							<p class="clearfix">
								<a href="#" class="float-left read btn btn-primary">Read more</a>
								<a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 ftco-animate">
					<div class="blog-entry">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
						</a>
						<div class="text px-4 pt-3 pb-4">
							<div class="meta">
								<div><a href="#">August 3, 2020</a></div>
								<div><a href="#">Admin</a></div>
							</div>
							<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
							<p class="clearfix">
								<a href="#" class="float-left read btn btn-primary">Read more</a>
								<a href="#" class="float-right meta-chat"><span class="fa fa-comment"></span> 3</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

 <section class="ftco-section bg-light">
<div class="container">
			<!-- Google Maps Section -->
			<div class="row justify-content-center mb-5 pb-5">
				<div class="col-md-7 text-center heading-section ftco-animate">
					<span class="subheading">Maps</span>
					<h2 class="mb-4">Lokasi Catering Kami</h2>
				</div>
			</div>
				<!-- Map Container -->
				<div class="card-body">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2041296.4257442676!2d113.8720768!3d-2.188902399999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423890458b6f3%3A0x9d253dd8a63cd7cd!2sCatering%20NAB%20Nizam%20al%20berkah!5e0!3m2!1sid!2sid!4v1727458744873!5m2!1sid!2sid"
                      width="600"
                      height="450"
                      style="border: 0; width: 100%"
                      allowfullscreen=""
                      loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                  </div>
		</section>
@endsection

@section('extra_js')

    <script>
        // Any additional JavaScript for the homepage
    </script>
@endsection
