# EasyForms

EasyForms is a clean and easy-to-use form library for PocketMine-MP. Designed to let you focus on your project and not on how the library works.

## Code examples

### General rules

All the closures passed to EasyForm classes must use its parent class as first and only argument.

### SimpleForm

Creating a form with a button without an icon:
```php
$form = new SimpleForm("This is the title");
$form->addButton(new Button("Say hi", null, function(Button $button) {
    $button->getPlayer()->sendMessage("Hello!");
}));
$player->sendForm($form);
```

Creating a form with a button with an icon:
```php
$form = new SimpleForm("This is the title");
$form->addButton(new Button("Press me!", new ButtonIcon("https://introduce-the-image-url.here"), function(Button $button) {
    $button->getPlayer()->sendMessage("Hey! Thanks for pressing me :)");
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

## Object oriented approach

In some cases, the forms are huge and mess up the code. In those cases, you can use a more object oriented approach to keep the code as clean as possible.   

```php
class ExampleForm extends SimpleForm {

    public function __construct() {
        parent::__construct("Form title");
    }

    protected function onCreation(): void {
        $button = new Button("A very very big button");
        $button->setIcon(new ButtonIcon("https://a-cool-url.i.think"));
        $button->setSubmitListener(function(Button $button) {
            $button->getPlayer()->sendMessage("Making this form was so easy!");
        });
        $this->addButton($button);
    }

}
```

Then you can send the forms as you normally would:
```php
$player->sendForm(new ExampleForm());
```





