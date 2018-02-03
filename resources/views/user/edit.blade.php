<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<form id="userPreferences" action="{{ route('user.update', Auth::id()) }}" method="post" style="margin: 50px auto; width: 80%">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <h3>Edit Preferences</h3>
    <div class="form-group">
        <input type="tel" name="phone" placeholder="Best number to reach you on" class="form-control" value="{{ Auth::user()->skype }}">
    </div>
    <div class="form-group">
        <input type="text" name="skype" placeholder="Skype Id or Url" class="form-control" value="{{ Auth::user()->hangout }}">
    </div>
    <div class="form-group">
        <input type="text" name="hangout" placeholder="Hangout Id or Url" class="form-control" value="{{ Auth::user()->call_guest }}">
    </div>
    <div class="form-group">
        <input type="checkbox" checked name="call_guest"> I will call my guest
    </div>
    <div class="form-group">
        <label>Preferred meeting location</label>
        <input type="text" name="meeting_location"  class="form-control" placeholder="Preferred meeting location" value="{{ Auth::user()->meeting_location }}">
    </div>
    <div class="form-group">
        <label>Preferred Time</label>
        <input type="time" name="preferred_time" class="form-control" value="{{ Auth::user()->preferred_time }}">
    </div>
    <div class="form-group">
        <label>Send me report</label>
        <input type="radio" checked name="report" class="form-control" value="Daily"> Daily
        <input type="radio" checked name="report" class="form-control" value="weekly">Weekly
        <input type="radio" checked name="report" class="form-control" value="Monthly"> Monthly
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Edit">
    </div>
</form>

<script>
    // wait for the DOM to be loaded
    $(function() {
        // bind 'myForm' and provide a simple callback function
        $('#userPreferences').ajaxForm(function() {
            alert("Preference updated");
            window.location.href="/";
        });
    });
</script>