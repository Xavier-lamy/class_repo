# Test Driven Developpment avec *Jasmine*

+ On écrit les comportemets attendu en BDD :
    - Given we have 510 Carambars in a box
    - when an employee take 20 carambars from the box
    - then we should still count 490 carambars in the box
    - and it shouldn't change anything to the dragibus quantity

    - Given we have 4 dragibus in a box
    - when an employee add 600 dragibus in the box
    - then we should count 604 dragibus in the box
    - and it shouldn't change the carambars quantity

- On commence le TDD
```js
describe("we have 510 carambars in a box", function() {
    it("should still have 490 carambars when an employee take 20 from the box", function() {
        expect(carambarCurrentQuantity).toEqual(490);
    });
    it("shouldn't change the dragibus quantity", function() {
        expect(dragibusCurrentQuantity).toEqual(604);
    })
});

describe("we have 4 dragibus in a box", function() {
    it("should have 604 dragibus when an employee add 600 dragibus", function() {
        expect(dragibusCurrentQuantity).toEqual(604);
    });
    it("shouldn't change the carambar quantity", function() {
        expect(carambarCurrentQuantity).toEqual(490);
    });
});
```