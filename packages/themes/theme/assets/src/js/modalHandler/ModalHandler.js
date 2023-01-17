import Api from './api/api';import {Modal} from 'bootstrap';export default class ModalHandler {    isLoading = false;    constructor(formId) {        if (typeof formId !== 'string') {            throw TypeError('formId has to be of type "STRING"')        }        this.form = document.getElementById(formId);        this.submitBtn = this.form.querySelector('button[type="submit"]');        this.API = new Api('wp-json/rvr');        this.modal = null;        this.init();    }    init() {        this.submitBtn.addEventListener('click', e => this.handleSubmitClick(e));    }    handleSubmitClick(e) {        e.preventDefault();        const button = e.currentTarget;        const modalId = button.dataset.bsTarget;        this.modal = this.modal ?? this.getModalById(modalId);        const modalContentId = button.dataset.contentId;        this.updateModalContent();        this.modal.instance.show();    }    getModalById(modalId) {        modalId = modalId.replace('#', '');        const modalNode = document.getElementById(modalId);        const modalInstance = Modal.getInstance(modalNode);        const modalBody = modalInstance._element.querySelector('.modal-body');        return {instance: modalInstance, body: modalBody};    }    updateModalContent() {        this.setLoadingState();        this.fetchModalContent();    }    fetchModalContent() {        this.API.getData('/modal').then(response => {           this.renderModalContent(response);        }).then(response => {            this.initContactForm()        });    }    renderModalContent(data) {        this.modal.body.innerHTML = data;    }    setLoadingState() {        this.modal.body.innerHTML = '' +            '<div class="row">' +            '<div class="col-12 text-center">' +            '<div class="spinner-grow text-primary" role="status">' +            '<span class="visually-hidden">Laden...</span>\<' +            '/div></div></div>'    }    initContactForm() {        let form = this.modal.body.getElementsByTagName('form').item(0);        wpcf7.init(form);    }}