<!-- Sign-Up Modal -->
<a href="#signupModal" class="btn btn-primary" id="signupBtn" style="color: aliceblue;">Sign Up</a>

<div id="signupModal" class="modal">
  <div class="modal-content">
    <a href="#" class="close" id="closeModal">&times;</a>
    <h2>Sign Up</h2>
    <form id="signupForm" action="" method="post">
      <label for="signupName">Name:</label><small id="statusMsg1"></small>
      <input type="text" id="signupName" name="name" placeholder="Enter your name" required>
      
      <label for="signupEmail">Email:</label><small id="statusMsg2"></small>
      <input type="email" id="signupEmail" name="email" placeholder="Enter your email" required>
      
      <label for="signupPassword">Password:</label><small id="statusMsg3"></small>
      <input type="password" id="signupPassword" name="password" placeholder="Enter your password" required>
      
      <label for="confirmPassword">Confirm Password:</label><small id="statusMsg4"></small>
      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
      
      <p class="error-message" id="errorMessage">Passwords do not match</p>
      <span id="successMsg"></span>
      <button onclick="addStu()" type="button" class="btn btn-primary" id=signup>Register</button>
    </form>
  </div>
</div>

<style>
  /* Modal styles */
  .modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
  }
  
  /* When the modal is targeted via the URL hash, display it */
  #signupModal:target {
    display: flex;
  }
  
  .modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    position: relative;
  }
  
  .modal-content h2 {
    margin-bottom: 20px;
  }
  
  .modal-content label {
    display: block;
    margin: 10px 0 5px;
    text-align: left;
  }
  
  .modal-content input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  .modal-content .btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
  }
  
  .modal-content .btn:hover {
    background-color: #0056b3;
  }
  
  .close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
  }
  
  .close:hover,
  .close:focus {
    color: black;
  }
  
  .error-message {
    margin-bottom: 10px;
    color: red;
    display: none;
  }
</style>
