<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

</head>
<body>
    <div class="container">
        <h1>Register</h1>


        <!-- ✅ Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- ✅ Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="regForm" method="POST" action="{{ url('register') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="first_last_name" placeholder="Full Name" required>
    
            <input type="email" name="email" placeholder="Email" required>
    
            <input type="password" name="password" placeholder="Password" required>
            
            <select name="country" required>
                <option value="">Select country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <option value="Canada">Canada</option>
            </select>

        <div class="gender-container">
            <label for="gender" class="main">Gender:</label>
            <label><input type="radio" name="gender" value="female" required> Female</label>
            <label><input type="radio" name="gender" value="male"> Male</label>
            <label><input type="radio" name="gender" value="other"> Other</label>
        </div>
        <input class="file-input" type="file" name="pic" required >
        <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="{{ url('login') }}">Login here</a></p>
    </div>

<script>
    document.getElementById('regForm').onsubmit = function() {
        let pic = this.pic.files[0];
        if (pic && pic.size > 2 * 1024 * 1024) {
            alert('Max file size 2MB');
            return false;
        }
    };
</script>
</body>
</html>
