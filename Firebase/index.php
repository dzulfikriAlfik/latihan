<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Firebase</title>
  <!-- <script src="https://www.gstatic.com/firebasejs/9.9.1/firebase-database.js"></script> -->
</head>

<body>
  <form id="form-submit">
    <input type="text" id="message" placeholder="Enter message" autocomplete="off">
    <input type="submit">
  </form>

  <ul id="messages"></ul>

  <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/6.6.1/firebase-database.js"></script>
  <script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyDviJIDFP58PchMGVcpuklHHF4G_xQ8kZ4",
      authDomain: "my-test-project-bd9da.firebaseapp.com",
      projectId: "my-test-project-bd9da",
      storageBucket: "my-test-project-bd9da.appspot.com",
      messagingSenderId: "273897770353",
      appId: "1:273897770353:web:69775c0c2bbde788e83ad0",
      databaseURL: "https://my-test-project-bd9da-default-rtdb.firebaseio.com",
    };

    firebase.initializeApp(firebaseConfig);

    var name = prompt("Enter your name");
    // var name = "Dzulfikri";

    const formSubmit = document.getElementById("form-submit");
    formSubmit.addEventListener("submit", event => {
      event.preventDefault();
      var message = document.getElementById("message").value;

      firebase.database().ref("messages").push().set({
        "sender": name,
        "message": message
      });
    });

    firebase.database().ref("messages").on("child_added", function(snapshot) {
      let html = `
        <li id="message-${snapshot.key}">
          ${snapshot.val().sender} : ${snapshot.val().message}
          ${isSender(snapshot, name)}
        </li>
      `;

      document.getElementById("messages").innerHTML += html;
    });

    function isSender(snapshot, name) {
      if (snapshot.val().sender == name) {
        return `
          <button data-id="${snapshot.key}" onclick="deleteMessage(this)">
            Delete
          </button>
        `;
      } else {
        return "";
      }
    }

    function deleteMessage(self) {
      let messageId = self.getAttribute("data-id");

      firebase.database().ref("messages").child(messageId).remove()
    }

    firebase.database().ref("messages").on("child_removed", function(snapshot) {
      document.getElementById(`message-${snapshot.key}`).innerHTML = "This message has been removed";
    });
  </script>
</body>

</html>