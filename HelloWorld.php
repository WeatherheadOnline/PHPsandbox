<html>
<head>
    <style>
        body {
            height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            position: relative;
            overflow: hidden;
            background-color: #61e9e9A1;
        }
        form {
            width: 80%;
            margin: 0 auto;
            max-width: 800px;
            min-width: 400px;
        }

        fieldset {
            margin: 1em 0;
            padding: 1em 0;
        }

        label {display: block;}

        .inputText, label {
            display: block;
            width: 60vw;
            min-width: 380px;
            max-width: 750px;
            margin: 0.5em auto;
        }

        .flexbox {
            display: flex;
            justify-content: space-between;
            width: 60vw;
            min-width: 380px;
            max-width: 750px;
            margin: auto;
        }

        #submitEmail {
            height: min-content;
        }

        .small {font-size: 0.8em;}
        .italic {
            font-style: italic;
            width: 60vw;
            min-width: 300px;
            max-width: 750px;
            margin: auto;
        }
    </style>
</head>
<body>
    
    <form method="POST">
        <fieldset>
            <legend> <span class="bold">(Optional)</span> What would you like to chat about? </legend>
            <label for="new" class="checkbox"><input type="checkbox" id="new" name="concern">Let's talk about a new project</label>
            <label for="existing" class="checkbox"><input type="checkbox" id="existing" name="concern">Let's discuss a project we're already working on together</label>
            <label for="dev" class="checkbox"><input type="checkbox" id="dev" name="concern">I'm a developer and I have a question</label>
            <label for="general" class="checkbox"><input type="checkbox" id="general" name="concern">I have a more general inquiry</label>
            <label for="other" class="checkbox"><input type="checkbox" id="other" name="concern">Something else</label>
            <label for="hi" class="checkbox"><input type="checkbox" id="hi" name="concern">Just saying hi</label>
        </fieldset>
        <fieldset>
            <h2 style="color: red; background-color: white;">Refresh page before sending</h2>
            <label for="userName" class="labelText">
                How may I address you? 
                <input type="text" id="userName" class="inputText" name="userName" required 
                    value="<?php echo isset($_POST['userName']) ? $_POST['userName'] : "" ?>">
            </label>
            <label for="returnAddress" class="labelText">
                What's your email address? 
                <input type="email" id="returnAddress" class="inputText" name="userEmail" required 
                    value="<?php echo isset($_POST['userEmail']) ? $_POST['userEmail'] : "" ?>">
            </label>
            <label for="subject" class="labelText">
                Subject: 
                <input type="text" id="messageSubject" class="inputText" name="subject" 
                    placeholder ="<?php echo isset($_POST['subject']) ? "" : "(optional)" ?>" 
                    value = "<?php echo isset($_POST['subject']) ? $_POST['subject'] : "" ?>" >
            </label>
            <div class="flexbox">
                <label for="body" class="labelText">
                    Type your message here: 
                    <textarea id="messageBody" class="inputText" name="message" rows="4" cols="60" required ><?php echo $_POST['message'] ?></textarea>
                </label>
                <button type="submit" id="submitEmail">Send message</button>
            </div>
            <p class="small italic">I won't share your email address with anyone, and I won't use it for any purpose other than replying to the message you're sending me here. By sending me a message here, you're implicitly giving me the "ok" to reply to you at this email address.</p>
        </fieldset>
    </form>

<?php

    $to = 'weatherheadonline@gmail.com';

    $subject = empty($_POST['subject']) ? "New message from contact form" : $_POST['subject'];

    $message = $_POST['message'] . "<br><br><em>Sent by " . $_POST['userName'] . "</em>";

    $headers = 'From: ' . $_POST['userEmail'] . "\r\n" .
        'Reply-To: weatherheadonline@gmail.com' . "\r\n" .
        'Content-type: text/html' . "\r\n";

    mail($to, $subject, $message, $headers);

?>

</body>
</html>
