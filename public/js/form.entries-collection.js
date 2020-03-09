var $contactsCollectionHolder;
var $addContactButton = $('<button type="button" class="btn btn-success add_contact_link">Add new contact</button>');
var $newContactLinkDiv = $('<div/>').append($addContactButton);

var $addressesCollectionHolder;
var $addAddressButton = $('<button type="button" class="btn btn-success add_address_link">Add new address</button>');
var $newAddressLinkDiv = $('<div/>').append($addAddressButton);

$(document).ready(function () {
    $contactsCollectionHolder = $('div.contacts');
    $contactsCollectionHolder.append($newContactLinkDiv);
    $contactsCollectionHolder.data('index', $contactsCollectionHolder.find('.contact-entry').length);

    $addressesCollectionHolder = $('div.addresses');
    $addressesCollectionHolder.append($newAddressLinkDiv);
    $addressesCollectionHolder.data('index', $addressesCollectionHolder.find('.address-entry').length);

    $addContactButton.on('click', function (e) {
        addContactForm($contactsCollectionHolder, $newContactLinkDiv, 'contact');
    });

    $addAddressButton.on('click', function (e) {
        addContactForm($addressesCollectionHolder, $newAddressLinkDiv, 'address');
    });
});

function addContactForm($collectionHolder, $newLinkDiv, $entityName) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);

    var $newFormFieldset = $('<fieldset class="form-group"/>').append(newForm);
    var $newFormDiv = $(`<div id="${$entityName}-${index}" class="contact-entry">`).append($newFormFieldset);

    $newLinkDiv.before($newFormDiv);
}