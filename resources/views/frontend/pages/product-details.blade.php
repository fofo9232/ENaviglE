@extends('frontend.layouts.master')

@section('title','Navigly')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="blog-single.html">Shop Details</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Shop Single -->
		<section class="shop single section">
					<div class="container">
						<div class="row"> 
							<div class="col-12">
								<div class="row">
									<div class="col-lg-6 col-12">
										<!-- Product Slider -->
										<div class="product-gallery">
											<!-- Images slider -->
											<div class="flexslider-thumbnails">
												<ul class="slides">
                                                
                                                @php 
									                 $photos = explode(',', $products->photo)

								            	@endphp
                                    @foreach($photos as $key =>$photo)
													<li data-thumb="images/bx-slider1.jpg" rel="adjustX:10, adjustY:">
                                                   <img src="{{$photo}}" alt="#">
                                                   
													</li>
												@endforeach

                                              
												</ul>
											</div>
											<!-- End Images slider -->
										</div>
										<!-- End Product slider -->
									</div>
									<div class="col-lg-6 col-12">
										<div class="product-des">
											<!-- Description -->
											<div class="short">
												<h4>{{$products -> title}}</h4>
												<div class="rating-main">
													<ul class="rating">
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star"></i></li>
														<li><i class="fa fa-star-half-o"></i></li>
														<li class="dark"><i class="fa fa-star-o"></i></li>
													</ul>
													<a href="#" class="total-review">(102) Review</a>
												</div>
												<p class="price"><span class="discount">${{number_format($products->discount, 2)}}</span><s>${{number_format($products->price, 2)}}</s> </p>
												<p class="description">{{$products->summary}}</p>
											</div>
											<!--/ End Description -->
											<!-- Color -->
											
											<!--/ End Color -->
											<!-- Size -->
											<!-- <div class="size"> 
												<h4>Size</h4>
												<ul>
													<li><a href="#" class="one">S</a></li>
			
												</ul>
											</div> -->
											<!--/ End Size -->
											<!-- Product Buy -->
											<div class="product-buy">
												<div class="quantity">
													<h6>Quantity :</h6>
													<!-- Input Order -->
													<div class="input-group">
														<div class="button minus">
															<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
																<i class="ti-minus"></i>
															</button>
														</div>
														<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
														<div class="button plus">
															<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
																<i class="ti-plus"></i>
															</button>
														</div>
													</div>
													<!--/ End Input Order -->
												</div>
												<div class="add-to-cart">
													<a href="{{route('add-to-cart',$products -> slug)}}" class="btn">Add to cart</a>
													<a href="#" class="btn min"><i class="ti-heart"></i></a>
													<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
												</div>
												
												<p class="availability">Availability : {{$products -> stock}} Products In Stock</p>
											</div>
											<!--/ End Product Buy -->
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="product-info">
											<div class="nav-main">
												<!-- Tab Nav -->
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
													<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
												</ul>
												<!--/ End Tab Nav -->
											</div>
											<div class="tab-content" id="myTabContent">
												<!-- Description Tab -->
												<div class="tab-pane fade show active" id="description" role="tabpanel">
													<div class="tab-single">
														<div class="row">
															<div class="col-12">
																<div class="single-des">
																	<p>{{$products->description}}</p>
																</div>
																
								
															</div>
														</div>
													</div>
												</div>
												<!--/ End Description Tab -->
												<!-- Reviews Tab -->
												<div class="tab-pane fade" id="reviews" role="tabpanel">
													<div class="tab-single review-panel">
														<div class="row">
															<div class="col-12">
																<div class="ratting-main">
																	<div class="avg-ratting">
																	@php

$reviews=\App\Models\ProductReview::where('product_id',$products->id)->latest()->get();
@endphp
																		<h4>{{number_format(\App\Models\ProductReview::where('product_id',$products->id)->avg('rate'))}} <span>(Overall)</span></h4>
																		<span>Based on {{\App\Models\ProductReview::where('product_id',$products->id)->count()}} Comments</span>
																	</div>
																	
																	<!-- Single Rating -->
																	
																	@if(count($reviews)>0)
																	@foreach($reviews as $review)
																	<div class="single-rating">
																	
																		<div class="rating-des">
																		
																			<h6>{{\App\Models\User::where('id',$review->user_id)->value('full_name')}}</h6>
																			on <span>{{\Carbon\Carbon::parse($review->created_at)->format('M, d Y')}}</span>
																			<div class="ratings">
																				<ul class="rating">
																					<li> @for($i=0; $i<5; $i++)
                                                               								 @if($review->rate>$i)
																							<i class="fa fa-star" aria-hidden="true"></i>
                                                               								 @else
                                                                   							 <i class="far fa-star" aria-hidden="true"></i>
                                                               								 @endif
                                                          								  @endfor
																					</li>
																				</ul>
																				<div class="rate-count">(<span>{{$review->rate}}</span>)</div>
																			</div>
																			<p>{{$review->review}}</p>
																		</div>
																	</div>
																	
																	<!--/ End Single Rating -->
																
																@endforeach
															@endif
																<!-- Review -->
																<div class="comment-review">
																	<div class="add-review">
																		<h5>Add A Review</h5>
																		<p>Your email address will not be published. Required fields are marked</p>
																	</div>
																	<form class="form" method="post" action="{{route('product.review',$products->slug)}}">
																	@csrf
																	<input type="hidden" name="product_id" value="{{$products->id}}">
																	<input type="hidden" name="user_id" value="{{auth()->user()->id}}">
																	<h4>Your Rating</h4>
																	<div class="review-inner">
																		<div class="ratings">					
																		
                                            <div class="stars">
                                                <input type="radio" name="rate" class="star-1" id="star-1" value="1">
                                                <label class="star-1" for="star-1">1</label>
                                                <input type="radio" name="rate" class="star-2" id="star-2" value="2">
                                                <label class="star-2" for="star-2">2</label>
                                                <input type="radio" name="rate" class="star-3" id="star-3" value="3">
                                                <label class="star-3" for="star-3">3</label>
                                                <input type="radio" name="rate" class="star-4" id="star-4" value="4">
                                                <label class="star-4" for="star-4">4</label>
                                                <input type="radio" name="rate" class="star-5" id="star-5" value="5">
                                                <label class="star-5" for="star-5">5</label>
                                                <span></span>
                                            </div>
                                            @error('rate')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror																																						
																</div>																																									
																	</div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group">
																				<label>Write a review<span>*</span></label>
																				<textarea name="review" rows="6" placeholder="" ></textarea>
																				

																			</div>
																		</div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group button5">	
																				<button type="submit" class="btn">Submit</button>
																			</div>
																		</div>
																	</div>
																</form>
																<!--/ End Form -->
															</div>
														</div>
													</div>
												</div>
												<!--/ End Reviews Tab -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!--/ End Shop Single -->
		
		<!-- Start Most Popular -->
	<div class="product-area most-popular related-product section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						@if(count($products->rel_prods)>0)
						@foreach($products->rel_prods as $item)
						@if($item->id != $products->id )
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="product-details.html">
								@php 
									$photo=explode(',',$item->photo)

									@endphp
									<img class="default-img" src="{{$photo[0]}}" alt="#">
									
									<span class="out-of-stock">{{$item->condition}}</span>
								</a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3><a href="{{route('product.details',$item->slug)}}">{{$item->title}}</a></h3>
								<div class="product-price">
									<span class="old">${{Helper::currency_converter($item->price)}}</span>
									<span>${{number_format($item->discount, 2)}}</span>
								</div>
							</div>
						</div>
						<!-- End Single Product -->
						@endif
						@endforeach
						@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	
	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <!-- Product Slider -->
									<div class="product-gallery">
										<div class="quickview-slider-active">
											<div class="single-slider">
												<img src="images/modal1.png" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal2.png" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal3.png" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal4.png" alt="#">
											</div>
										</div>
									</div>
								<!-- End Product slider -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="quickview-content">
                                    <h2>Flared Shift Dress</h2>
                                    <div class="quickview-ratting-review">
                                        <div class="quickview-ratting-wrap">
                                            <div class="quickview-ratting">
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <a href="#"> (1 customer review)</a>
                                        </div>
                                        <div class="quickview-stock">
                                            <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                        </div>
                                    </div>
                                    <h3>$29.00</h3>
                                    <div class="quickview-peragraph">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                    </div>
									<div class="size">
										<div class="row">
											<div class="col-lg-6 col-12">
												<h5 class="title">Size</h5>
												<select>
													<option selected="selected">s</option>
													<option>m</option>
													<option>l</option>
													<option>xl</option>
												</select>
											</div>
											<div class="col-lg-6 col-12">
												<h5 class="title">Color</h5>
												<select>
													<option selected="selected">orange</option>
													<option>purple</option>
													<option>black</option>
													<option>pink</option>
												</select>
											</div>
										</div>
									</div>
                                    <div class="quantity">
										<!-- Input Order -->
										<div class="input-group">
											<div class="button minus">
												<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
													<i class="ti-minus"></i>
												</button>
											</div>
											<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
											<div class="button plus">
												<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
													<i class="ti-plus"></i>
												</button>
											</div>
										</div>
										<!--/ End Input Order -->
									</div>
									<div class="add-to-cart">
										<a href="#" class="btn">Add to cart</a>
										<a href="#" class="btn min"><i class="ti-heart"></i></a>
										<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
									</div>
                                    <div class="default-social">
										<h4 class="share-now">Share:</h4>
                                        <ul>
                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                            <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- Modal end -->
@endsection