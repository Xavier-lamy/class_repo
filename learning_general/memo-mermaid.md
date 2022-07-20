# Mermaid (diagrammes pour markdown)
- [Voir la doc Mermaid](https://mermaid-js.github.io/mermaid/#/) pour plus de détails
- Preview:
    - Par défaut Mermaid n'est pas rendu en preview sur vscode, on peut ajouter un plugin (ex: ``Markdown Preview Mermaid Support`` par Matt Bierner). 
    - La preview est dispo sur gitlab et sur github
    - Il est aussi possible de l'utiliser dans un fichier HTML (voir la doc) notamment via un cdn
- Pour l'utiliser dans notre ``.md`` il suffit d'ajouter un bloc de code ``mermaid``:

### Exemples de diagrammes
#### [Flowchart](https://mermaid-js.github.io/mermaid/#/flowchart)
```mermaid
graph TD;
    A-->B;
    A-->C;
    B-->D;
    C-->D;
```

#### [Sequence diagram](https://mermaid-js.github.io/mermaid/#/sequenceDiagram)
```mermaid
sequenceDiagram
    participant Alice
    participant Bob
    Alice->>John: Hello John, how are you?
    loop Healthcheck
        John->>John: Fight against hypochondria
    end
    Note right of John: Rational thoughts <br/>prevail!
    John-->>Alice: Great!
    John->>Bob: How about you?
    Bob-->>John: Jolly good!
```

#### [Gantt diagram](https://mermaid-js.github.io/mermaid/#/gantt)
```mermaid
gantt
dateFormat  YYYY-MM-DD
title Adding GANTT diagram to mermaid
excludes weekdays 2014-01-10

section A section
Completed task            :done,    des1, 2014-01-06,2014-01-08
Active task               :active,  des2, 2014-01-09, 3d
Future task               :         des3, after des2, 5d
Future task2               :         des4, after des3, 5d
```

#### [Class diagram](https://mermaid-js.github.io/mermaid/#/classDiagram)
```mermaid
classDiagram
Class01 <|-- AveryLongClass : Cool
Class03 *-- Class04
Class05 o-- Class06
Class07 .. Class08
Class09 --> C2 : Where am i?
Class09 --* C3
Class09 --|> Class07
Class07 : equals()
Class07 : Object[] elementData
Class01 : size()
Class01 : int chimp
Class01 : int gorilla
Class08 <--> C2: Cool label
```

#### [Gitgraph diagram (Experimental)](https://mermaid-js.github.io/mermaid/#/README)
```mermaid
gitGraph:
options
{
    "nodeSpacing": 150,
    "nodeRadius": 5
}
end
commit
branch newbranch
checkout newbranch
commit
commit
checkout master
commit
commit
merge newbranch
```

#### [Requirement Diagrams](https://mermaid-js.github.io/mermaid/#/requirementDiagram)
```mermaid
requirementDiagram

requirement test_req {
id: 1
text: the test text.
risk: high
verifymethod: test
}

element test_entity {
type: simulation
}

test_entity - satisfies -> test_req
```

#### [Entity Relationship Diagram (Experimental)](https://mermaid-js.github.io/mermaid/#/entityRelationshipDiagram)
```mermaid
erDiagram
    CUSTOMER ||--o{ ORDER : places
    ORDER ||--|{ LINE-ITEM : contains
    CUSTOMER }|..|{ DELIVERY-ADDRESS : uses
```

Plus d'explications: 
+ ces diagrammes sont basés sur la notification ``crow's foot`` qui permettent de montrer des relation oneToMany ou manyToMany optionnels ou obligatoires:
    - L'anneau ``o`` représente un 0
    - Le trait ``|`` représente le 1
    - et le ***crow's feet*** ``{ ou }`` repésente **plusieurs** ou une **infinité**
+ Ensuite on les utilise par paire, l'élement vers l'extérieur représente la valeur maximum, celui vers l'intérieur représente le minimum, on peut donc avoir:
    - ``o|``: minimum 0, maximum 1 (relation optionnel)
    - ``||``: minimum 1, maximum 1 (relation obligatoire)
    - ``o{``: minimum 0, maximum plusieurs/infini (relation optionnel)
    - ``|{``: minimum 1, maximum plusieurs/infini (relation obligatoire)
+ Ensuite mermaid ajoute soit ``--`` rendu par un trait continu si l'élément est défini par sa relation, ou ``..`` rendu par un trait pointillé s'il ne l'est pas (exemple: dans le cas d'une table voiture, une table personne, et une table conducteur, le conducteur est défini par le fait qu'il est une personne et qu'il conduit une voiture, c'est donc une relation qui le définit (``--``), il ne peut exister si une des deux tables n'existent pas, en revanche la relation entre personne et voiture ne les définit pas (``..``) , une voiture peut exister sans une personne et la personne peut exister sans la voiture)


ring and dash → minimum zero, maximum one (optional)
dash and dash → minimum one, maximum one (mandatory)
ring and crow's foot → minimum zero, maximum many (optional)
dash and crow's foot → minimum one, maximum many (mandatory)

#### [State Diagram](https://mermaid-js.github.io/mermaid/#/stateDiagram)
```mermaid
stateDiagram-v2
    [*] --> Still
    Still --> [*]

    Still --> Moving
    Moving --> Still
    Moving --> Crash
    Crash --> [*]
```

#### [Pie Chart](https://mermaid-js.github.io/mermaid/#/pie)
```mermaid
pie title Pets adopted by volunteers
    "Dogs" : 386
    "Cats" : 85
    "Rats" : 15
```

#### [User Journey Diagram](https://mermaid-js.github.io/mermaid/#/user-journey)
```mermaid
journey
    title My working day
    section Go to work
        Make tea: 5: Me
        Go upstairs: 3: Me
        Do work: 1: Me, Cat
    section Go home
        Go downstairs: 5: Me
        Sit down: 5: Me
```
