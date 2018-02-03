<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<form action="{{route('cal.store')}}" method="POST" role="form" id="createTask">
    {{csrf_field()}}
    <legend>
        Create Task
    </legend>
    <div class="form-group">
        <label for="title">
            Title
        </label>
        <input class="form-control" name="title" placeholder="Title" type="text">
    </div>
    <div class="form-group">
        <label for="description">
            Description
        </label>
        <input class="form-control" name="description" placeholder="Description" type="text">
    </div>
    <div class="form-group">
        <label for="start_date">
            Start Date
        </label>
        <input class="form-control" name="start_date" placeholder="Start Date" type="text">
    </div>
    <div class="form-group">
        <label for="end_date">
            End Date
        </label>
        <input class="form-control" name="end_date" placeholder="End Date" type="text">
    </div>
    <button class="btn btn-primary" type="submit">
        Submit
    </button>
</form>

<script>
    $(function() {
        $('#createTask').ajaxForm(function() {
            alert("Task created!");
            window.location.href="/";
        });
    });
</script>