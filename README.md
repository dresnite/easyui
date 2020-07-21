# EasyForms

EasyForms is a clean and easy-to-use form library for PocketMine-MP. Designed to let you focus on your project and not on how the library works.

## Code examples

### General rules

All the closures passed to EasyForm classes must declare a variable of the class Player as first and only argument.

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
$form->setCloseListener(function(SimpleForm $form) {
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
$form->setDenyText("Yes");
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

Then you can send the forms as you normally would:
```php
$player->sendForm(new ExampleForm());
```





