# EasyUI

EasyUI is an intuitive and easy-to-use form library for PocketMine-MP. Designed to let you focus on your project and not on how the library works.

## Code examples

### General rules

All the closures passed to EasyUI classes must declare a variable of the class Player as first and only argument, except for the CustomForm submit listener, which also requires FormResponse as second parameter.

### SimpleForm

Creating a form with a button without an icon:
```php
$form = new SimpleForm("This is the title");
$form->addButton(new Button("Say hi", null, function(Player $player) {
    $player->sendMessage("Hello!");
}));
$player->sendForm($form);
```

Creating a form with a button with an icon:
```php
$form = new SimpleForm("This is the title");
$form->addButton(new Button("Press me!", new ButtonIcon("https://introduce-the-image-url.here"), function(Player $player) {
    $player->sendMessage("Hey! Thanks for pressing me :)");
}));
$player->sendForm($form);
```

Creating a form with a header text (optional):
```php
new SimpleForm("This is the title", "This is the header text");
```

Controlling what happens when a form closes (optional):
```php
$form->setCloseListener(function(Player $player) {
    echo "The form was closed!";
})
```

### ModalForm

Creating a modal form and handling what happens when the player presses "accept" or "deny":
```php
$form = new ModalForm("The title goes here!", "Do you want this plugin to save you a lot of time?");
$form->setAcceptListener(function(Player $player) {
    $player->sendMessage("Great! Keep building good software");
});

$form->setDenyListener(function(Player $player) {
    $player->sendMessage("Whatever :/");
});

```

You can also change the text of the buttons:
```php
$form->setAcceptText("Yes");
$form->setDenyText("Yesn't");
```

### CustomForm

Creating a custom form with an input and a dropdown
```php
$form = new CustomForm("This is the title!");
$form->addElement("my_text", new Input("This is the input header text!"));

$dropdown = new Dropdown("This is the dropdown header text");
$dropdown->addOption(new Option("broadcast", "Broadcast message"));
$dropdown->addOption(new Option("send_to_myself", "Send message to myself"));

$form->addElement("what_to_do", $dropdown);

$form->setSubmitListener(function(Player $player, FormResponse $response) {
    $submittedText = $response->getInputSubmittedText("my_text");
    $submittedOption = $response->getDropdownSubmittedOptionId("what_to_do");
    if($submittedOption === "send_to_myself") {
        $player->sendMessage($submittedText);
    } elseif($submittedOption === "broadcast") {
        foreach($player->getServer()->getOnlinePlayers() as $onlinePlayer) {
            $onlinePlayer->sendMessage("[BROADCAST] $submittedText");
        }
    }
});
``` 

## Object oriented approach

In some cases, the forms are huge and mess up the code. In those cases, you can use a more object oriented approach to keep the code as clean as possible.   

### SimpleForm

```php
class ExampleForm extends SimpleForm {

    public function __construct() {
        parent::__construct("Form title");
    }

    protected function onCreation(): void {
        $button = new Button("A very very big button");
        $button->setIcon(new ButtonIcon("https://a-cool-url.i.think"));
        $button->setSubmitListener(function(Player $player) {
            $player->sendMessage("Making this form was so easy!");
        });
        $this->addButton($button);
    }

}
```

### ModalForm

```php
class ExampleForm extends ModalForm {
    
    public function __construct() {
        parent::__construct("The title", "The content text");
    }

    protected function onAccept(Player $player): void {
        $player->sendMessage("You pressed 'Accept' <3");
    }

    protected function onDeny(Player $player): void {
        $player->sendMessage("You pressed 'Deny' >:(");
    }

}
```
**NOTE**: `onCreation()` is also available on ModalForms.

### CustomForm
```php
class ExampleForm extends CustomForm {

    public function __construct() {
        parent::__construct("The title goes here");
    }

    public function onCreation(): void {
        // You can add the elements here
    }

    public function onSubmit(Player $player, FormResponse $response): void {
        // You can modify the response here
    }


}
```

Then you can send the forms as you normally would with:
```php
$player->sendForm(new ExampleForm());
```





