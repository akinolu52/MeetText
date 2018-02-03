
<link rel="stylesheet" type="text/css" href="{{ asset('css/chart-style.css') }}" />

<main class="page__main">
    <div class="block--background">
        <div class="chatbot__overview">
            <ul class="chatlist">
                <li class="bot__output bot__output--standard">Hey, I'm Teek!</li>
                <li class="bot__output bot__output--standard">
                    <span class="bot__output--second-sentence">You can ask me a bunch of things!</span>
                    <ul>
                        <li class="input__nested-list">Something <span class="bot__command">about</span> Teek</li>
                        <li class="input__nested-list">Maybe I could <span class="bot__command">help</span> (for more instructions)</li>
                        <li class="input__nested-list">Type <span class="bot__command">commands</span> for a list of every command</li>
                    </ul>
                    You could also scroll down to see Mees' full portfolio
                </li>
            </ul>
        </div>
        <div class="chatbox-area">
            <form action="" id="chatform">
                <textarea placeholder="Talk to me!" class="chatbox" name="chatbox" resize: "none" minlength="2"></textarea>
                <input class="submit-button" type="submit" value="send">
            </form>
        </div>
        <div class="block--background"></div>
    </div>
</main>

<script src="{{ asset('js/chat.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
