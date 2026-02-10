<form method="POST" action="{{ route('student.send-otp') }}">
    @csrf
    <input type="email" name="email" placeholder="Your Email" required>
    <button type="submit">Send OTP</button>
</form>
