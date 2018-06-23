# refactoring_example
Refactoring example with classes Film, Rental, Customer

NOTES on the refactoring

The calculating of charges logic was rather convoluted and doesn't belong well in the Customer class.  This logic may be useful elsewhere, but in the former version there was no means of accessing this logic.  Copying and pasting to repurpose this code could result in duplication and difficulties in updating the logic should pricing change.  This new version means pricing is encapsulated in the Film class.

There was also some logic about frequent renting points.  Actually there was redundant code as it wasn't being used in the statement method once it was calculated.  I have kept this logic but moved it again to the Film class where it can be more easily maintained.

An alternative approach would be to use inheritance so that there are NewReleaseFilm and ChildrensFilm subclasses which override a getPrice method.  This is perhaps overcomplicating things in this example but may be a useful approach in some circumstances.

The resulting code is I hope much easier to understand and maintain.
