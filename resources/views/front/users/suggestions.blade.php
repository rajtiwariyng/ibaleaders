<!-- Suggestions Section -->
    
        <div class="whiteBox bg-white p-3 mb-3">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="blue poppins-bold mb-0 fs-6">Suggestions</h5>
                <div class="d-flex align-items-center siderbar-search">
                    <div class="al-search d-flex justify-content-end w-100">
                        <button class="border-0 bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="text" placeholder="Search" id="suggestionssearch" name="suggestionssearch">
                    </div>
                </div>
            </div>
            <div id="suggestionssearchid">

            @forelse ($suggestions as $suggestion)
                <div class="notification-wrapper mb-4">
                    <div class="note-img">
                        <img src="{{ $suggestion->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="">
                    </div>
                    <div class="note-content">
                        <p class="mb-0 fs-7">
                            <a href='{{ URL::route("user.connection.userprofile", [base64_encode($suggestion->id)]) }}' class="grey">
                                <strong>{{ $suggestion->name }}</strong>
                            </a>
                        </p>
                        <p class="mb-0 fs-8">{{ $suggestion->industry ?? 'N/A' }}</p>
                    </div>
                    <div class="sr-btn">
                        <form action="{{ route('user.sendConnection') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $suggestion->id }}">
                            <button class="bg-blue btn text-white fs-8" type="submit">Send Request</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No suggestions available.</p>
            @endforelse
            </div>
        </div>
    </div>

