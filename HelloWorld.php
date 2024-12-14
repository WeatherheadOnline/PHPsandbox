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
        #nameAndEmail  {
            display: grid;
            gap: 10%;
            width: 60vw;
            min-width: 380px;
            max-width: 750px;
            margin: 0 auto;
            grid-template-columns: 40% 50%;
            justify-content: space-between;
        }
        #formButtons {
            display: flex;
            justify-content: right;
            width: 60vw;
            min-width: 380px;
            max-width: 750px;
            margin: auto;
        }
        #formbuttons button {
            padding: 0.3rem;
            margin: 0.5rem;
        }
        #submitEmail {height: min-content;}
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
            <legend> <span class="bold">~(Optional)~ </span> What would you like to chat about? </legend>
            <label for="new" class="radio">
                <input type="radio" id="new" name="concern" value="new">Let's talk about a new project</label>
            <label for="existing" class="radio">
                <input type="radio" id="existing" name="concern" value="existing">Let's discuss a project we're already working on together</label>
            <label for="dev" class="radio">
                <input type="radio" id="dev" name="concern" value="dev">I'm a developer and I have a question</label>
            <label for="general" class="radio">
                <input type="radio" id="general" name="concern" value="general">I have a more general inquiry</label>
            <label for="other" class="radio">
                <input type="radio" id="other" name="concern" value="other">Something else</label>
            <label for="hi" class="radio">
                <input type="radio" id="hi" name="concern" value="hi">Just saying hi</label>
        </fieldset>

        <fieldset>
            <div id="nameAndEmail">  
                <div id="userNameWrapper">
                    <label for="userName" class="labelText">
                        What's your name? 
                    </label>
                    <input type="text" id="userName" name="userName" required 
                        value="<?php echo isset($_POST['userName']) ? $_POST['userName'] : "" ?>">
                </div>
                <div id="returnAddressWrapper">
                    <label for="returnAddress" class="labelText">
                        What's your email address? 
                    </label>
                        <input type="email" id="returnAddress" name="userEmail" required 
                            value="<?php echo isset($_POST['userEmail']) ? $_POST['userEmail'] : "" ?>">
                </div>
            </div>
            <label for="subject" class="labelText">
                Subject: 
                <input type="text" id="messageSubject" class="inputText" name="subject" 
                    placeholder ="<?php echo isset($_POST['subject']) ? "" : "(optional)" ?>" 
                    value = "<?php echo isset($_POST['subject']) ? $_POST['subject'] : "" ?>" >
            </label>
            <label for="body" class="labelText">
                Type your message here: 
                <textarea id="messageBody" class="inputText" name="message" rows="4" cols="60" required ><?php echo $_POST['message'] ?></textarea>
            </label>
            <div id="formButtons">
                <button type="" id="clearForm">Clear the form</button>
                <button type="submit" id="submitEmail">Send message</button>
            </div>
            <p class="small italic">I won't share your email address with anyone, and I won't use it for any purpose other than replying to the message you're sending me here. By sending me a message here, you're implicitly giving me the "ok" to reply to you at this email address.</p>
        </fieldset>
    </form>
    
<script>
    const button = document.getElementById("clearForm");
    button.addEventListener("click", clearForm);

    function clearForm() {
        document.getElementById("userName").value = "";
        document.getElementById("returnAddress").value = "";
        document.getElementById("messageSubject").value = "";
        document.getElementById("messageBody").innerText = "";
    }
</script>

<?php

    if (isset ($_POST['concern'])) {
        switch ($_POST['concern']) {
            case 'new':
                $concern = "Let's talk about a new project.";
                break;
            case 'existing':
                $concern = "Let's discuss a project we're already working on together.";
                break;
            case 'dev':
                $concern = "I'm a developer and I have a question.";
                break;
            case 'general':
                $concern = "I have a more general inquiry.";
                break;
            case 'other':
                $concern = "Something else.";
                break;
            case 'hi':
                $concern = "Just saying hi.";
                break;
            default: 
                "Error, or no option was selected.";
        }
    }

    date_default_timezone_set("America/Denver");
    
    $subject = empty($_POST['subject']) 
        ? "New message from contact form on " . date("m/d/Y") . " at " . date("h:ia") 
        : $_POST['subject'];

    $message = $_POST['message'] . "<br><br><em>Sent by " . $_POST['userName'] . "</em>";
        if ( isset($_POST['concern']) ) {
            $message = $message . "<em>; Reason for contact: " . $concern . "</em>";
        }
    
    $headers = 'From: ' . $_POST['userEmail'] . "\r\n" .
        'Reply-To: weatherheadonline@gmail.com, ' . $_POST['userEmail'] . "\r\n" .
        'Content-type: text/html' . "\r\n";
        // 'BCC: eddie.weatherhead@gmail.com' . "\r\n";   // in production, change this to WO@g.com & change "to" and "reply-to" to e@WO.com

    $to = 'Eddie <weatherheadonline@gmail.com>';
    mail($to, $subject, $message, $headers);
?>

</body>
</html>
