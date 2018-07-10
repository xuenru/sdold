var $collectionHolder;

// setup an "add a option" link
var $addoptionButton = $('<button type="button" class="btn btn-info">Ajouter option</button>');
var $newLinkLi = $('<li></li>').append($addoptionButton);

jQuery(document).ready(function () {
    // Get the ul that holds the collection of options
    $collectionHolder = $('ul.options');

    // add the "add a option" anchor and li to the options ul
    $collectionHolder.append($newLinkLi);

    //add delete button for each option
    $('ul.options li').each(function () {
        addTagFormDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addoptionButton.on('click', function (e) {
        // add a new option form (see next code block)
        addoptionForm($collectionHolder, $newLinkLi);
    });
});

function addoptionForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a option" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button" class="btn btn-danger">Supprimer option</button><br><br>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function (e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}