# Example code
 
## [`FooSetting`](FooSetting.php)

This is an entity extending the abstract one. This way you can use the abstract handler and only define the fields you need, without the boilerplate.

The `isEmpty` method regulates when to delete the entity altogether (instead of keeping empty data in the db)

## [`FooSettingAdminType`](FooSettingAdminType.php)

This is a simple Form Type for the entity. There is nothing special about it, it’s like any other form.

## [`FooSettingsHandler`](FooSettingsHandler.php)

This handler only returns:

 * The handler name
 * The entity name (it’s class, but you can also use `BundleName\Entity` notation if you’d like)
 * And the Form Type name, it’s class name in this example 

The handler needs to be registered in the container:

```yaml

# Resources/config/services.yml

services:
    foo.settings.handler:
        class: FooSettingsHandler
        arguments: [ @doctrine.orm.entity_manager ] # abstract handler requires this
        tags: 
           - name: nassau.node_settings # crucial! 

```


## What else?

Well, that’s it. The usage of this entity is up to you, the bundle only configures the admin panel to set it up.
