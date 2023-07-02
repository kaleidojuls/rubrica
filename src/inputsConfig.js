const inputsConfig = {
    configImmagineContatto: {
        type: "file",
        nameId: "immagine_contatto",
        placeholder: false,
        value: false,
        required: false,
        hasFeedbackBox: false,
        hasIcon: false,
        iconName: ""
    },

    configNome: {
        type: "text",
        nameId: "nome",
        placeholder: "*Nome",
        value: false,
        required: true,
        hasFeedbackBox: true,
        hasIcon: true,
        iconName: "bi-person-fill"
    },

    configCognome: {
        type: "text",
        nameId: "cognome",
        placeholder: "Cognome",
        value: false,
        required: false,
        hasFeedbackBox: true,
        hasIcon: false,
        iconName: ""
    },

    configSocieta: {
        type: "text",
        nameId: "societa",
        placeholder: "Società",
        value: false,
        required: false,
        hasFeedbackBox: true,
        hasIcon: true,
        iconName: "bi-briefcase-fill"
    },

    configQualifica: {
        type: "text",
        nameId: "qualifica",
        placeholder: "Qualifica",
        value: false,
        required: false,
        hasFeedbackBox: true,
        hasIcon: false,
        iconName: ""
    },

    configEmail: {
        type: "email",
        nameId: "email",
        placeholder: "*Example.mail@email.com",
        value: false,
        required: true,
        hasFeedbackBox: true,
        hasIcon: true,
        iconName: "bi-envelope-fill"
    },

    configNumero: {
        type: "tel",
        nameId: "numero",
        placeholder: "*Numero di telefono",
        value: false,
        required: true,
        hasFeedbackBox: true,
        hasIcon: true,
        iconName: "bi-telephone-fill"
    },

    configCompleanno: {
        type: "date",
        nameId: "compleanno",
        placeholder: false,
        value: false,
        required: false,
        hasFeedbackBox: true,
        hasIcon: true,
        iconName: "bi-gift-fill"
    }
};

export default inputsConfig;

