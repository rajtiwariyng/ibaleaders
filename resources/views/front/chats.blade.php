@extends('front.layouts.app')
@section('content')
      <div class="container">
        <div class="page-inner">
          <h5 class="blue poppins-bold pb-3">Chats</h5>
          <div class="row">
            <div class="col-md-5">
              <div class="chat-user-list whiteBox bg-white">
                <div class="chat-user-list__box">
                    <div class="chat-user-list__head">
                        <div class="avatar">
                          <img src="{{ asset('front-assets/images/sauro.jpg') }}" alt="profile">
                        </div>
                        <div class="ps-3">
                          <h6 class="mb-0 fs-7">You</h6>
                          <p class="fs-8 mb-0">Real Estate Consultant</p>
                        </div>
                    </div>
                    <div class="input-group chatSearch">
                      <input type="text" placeholder="Search ..." class="form-control fs-7 border-0">
                      <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search bg-blue">
                          <img src="{{ asset('front-assets/icons/search.png') }}" alt="">
                        </button>
                      </div>
                    </div>
                    <div class="chat-user-list__body">
                        <ul>
                            <li>
                                <div class="user-item --active">
                                    <div class="user-item__avatar">
                                      <img src="{{ asset('front-assets/images/chadengle.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Lester Barry</a></div>
                                        <div class="user-item__text">Let’s play now!</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">4m</div>
                                        <div class="user-item__count">1</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-item --active">
                                    <div class="user-item__avatar"><img src="{{ asset('front-assets/images/arashmil.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Emma Stone</a></div>
                                        <div class="user-item__text">Are you here?</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">10m</div>
                                        <div class="user-item__count">2</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-item">
                                    <div class="user-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Sofia Dior</a></div>
                                        <div class="user-item__text">You: Good I will wait you in the ga...</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">1h</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-item">
                                    <div class="user-item__avatar"><img src="{{ asset('front-assets/images/profile2.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Phillip Martin</a></div>
                                        <div class="user-item__text">I will go to sleep</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">3h</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-item">
                                  <div class="user-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Christian John</a></div>
                                        <div class="user-item__text">Am waiting for this new game to be...</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">5h</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-item">
                                  <div class="user-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Guzman Williams</a></div>
                                        <div class="user-item__text">You: I will go AFK</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">1d</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-item">
                                    <div class="user-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                                    <div class="user-item__desc">
                                        <div class="user-item__name"><a href="https://pro-theme.com/html/teamhost/06_chats.html">Olivia Mark</a></div>
                                        <div class="user-item__text">I will go AFK</div>
                                    </div>
                                    <div class="user-item__info">
                                        <div class="user-item__time">1d</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="chat-messages-box">
                <div class="chat-messages-head">
                    <div class="user-item">
                        <div class="user-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="user-item__desc">
                            <div class="user-item__name">James Dior</div>
                            <div class="active-user fs-8 blue">Active Now</div>
                        </div>
                    </div>
                    <div class="d-flex">
                      <a class="ico_call" href="#"><i class="fa-solid fa-phone"></i></a>
                      <a class="ico_info-circle" href="#"><i class="fa-brands fa-square-whatsapp fa-lg" style="color: #32d851;"></i></a>
                      <div class="dropdown ellipse-action ms-4">
                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa-solid fa-ellipsis-vertical fs-6"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Block</a>
                          <a class="dropdown-item" href="#">Delete chat</a>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="chat-messages-body">
                    <div class="messages-item --your-message">
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="messages-item__text">Which game you play now?</div>
                    </div>
                    <div class="messages-item --friend-message">
                        <div class="messages-item__text">I play Stronghold Kingdoms</div>
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                    </div>
                    <div class="messages-item --your-message">
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="messages-item__text">What type of game is this? is it a strategy game?</div>
                    </div>
                    <div class="messages-item --friend-message">
                        <div class="messages-item__text">Yes</div>
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                    </div>
                    <div class="messages-item --your-message">
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="messages-item__text">Wow! it seems amazing I will download it!</div>
                    </div>
                    <div class="messages-item --friend-message">
                        <div class="messages-item__text">Good I will wait you in the game!</div>
                        <div class="messages-item__avatar"><img src="images/mlane.jpg') }}" alt="user"></div>
                    </div>
                    <div class="messages-item --your-message">
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="messages-item__text">Which game you play now?</div>
                    </div>
                    <div class="messages-item --friend-message">
                        <div class="messages-item__text">I play Stronghold Kingdoms</div>
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                    </div>
                    <div class="messages-item --your-message">
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="messages-item__text">What type of game is this? is it a strategy game?</div>
                    </div>
                    <div class="messages-item --friend-message">
                        <div class="messages-item__text">Yes</div>
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                    </div>
                    <div class="messages-item --your-message">
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/jm_denis.jpg') }}" alt="user"></div>
                        <div class="messages-item__text">Wow! it seems amazing I will download it!</div>
                    </div>
                    <div class="messages-item --friend-message">
                        <div class="messages-item__text">Good I will wait you in the game!</div>
                        <div class="messages-item__avatar"><img src="{{ asset('front-assets/images/mlane.jpg') }}" alt="user"></div>
                    </div>
                </div>
                <div class="chat-messages-footer">
                    <form action="#!">
                        <div class="chat-messages-form">
                            <div class="chat-messages-form-btns">
                              <button class="ico_emoji-happy">
                                <i class="fa-regular fa-face-laugh"></i>
                              </button>
                              <button class="ico_gallery">
                                <i class="fa-regular fa-image"></i>
                              </button>
                            </div>
                            <div class="chat-messages-form-controls"><input class="chat-messages-input" type="text" placeholder="Type a message"></div>
                            <div class="chat-messages-form-btn">
                              <button class="ico_microphone" type="button"><i class="fa-solid fa-microphone"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
          </div>
        </div>
        
@endsection

@section('customJs')

@endsection  