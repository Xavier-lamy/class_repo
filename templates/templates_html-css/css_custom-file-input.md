# custom input file
```scss
.fileupload__container input {
    color: transparent;
}
.fileupload__container input::-webkit-file-upload-button {
    visibility: hidden;
}
  
.fileupload__container input::before {
    content: "Ajouter une pièce jointe";
    display: inline-block;
    color: $blue;
    border: 1px $blue dashed;
    border-radius: $rounded;
    background: $white url('path/img/import_file.svg') no-repeat;
    background-position: 5% 50%;
    padding: .2rem .3rem .2rem 2rem;
    outline: none;
    white-space: nowrap;
    user-select: none;
    -webkit-user-select: none;
    cursor: pointer;
    font-weight: 400;
}

.fileupload__container input:focus {
    outline: none;
}

.fileupload__container input:active::before {
    transform: scale(.9) translate(0px, 2px);
    box-shadow:  inset 4px 4px 5px 0px rgba(0, 0, 0, 0.20);      
}
```