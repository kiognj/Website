// creating a custom log out confirm message
function logout() {
    // creating an object
    confirm().open({
        title: 'Log out',
        message: 'Are you sure you want to log out?',
        onok: () => {
            // sends to php logout page
            window.location.href = "./logic/logout.php";
        }
    });
}

// creating custom delete message when deleting record of footprint
function remove() {
    confirm().open({
        title: 'Delete record',
        message: `Are you sure you want to delete the record?`,
        onok: () => {
            // sends to php logout page
            window.location.href = "./logic/delete.php";
        }
    });
}


function confirm() {
    // creating an object
    const Confirm = {
        open(options) {
            options = Object.assign({}, {
                title: '',
                message: '',
                okText: 'Yes',
                cancelText: 'No',
                onok: function () { },
                oncancel: function () { }
            }, options);

            // html code to be inserted
            const html = `
                <div class="confirm">
                    <div class="confirm__window">
                        <div class="confirm__titlebar">
                            <span class="confirm__title">${options.title}</span>
                            <button class="confirm__close">&times;</button>
                        </div>
                        <div class="confirm__content">${options.message}</div>
                        <div class="confirm__buttons">
                            <button class="confirm__button confrim__button--ok">${options.okText}</button>
                            <button class="confirm__button confrim__button--cancel  confirm__button--fill">${options.cancelText}</button>
                        </div>
                    </div>
                </div>
            `;

            // creating an element from html code
            const template = document.createElement('template');
            template.innerHTML = html;
            // console.log(template);

            const confirmEl = template.content.querySelector(".confirm");
            const btnClose = template.content.querySelector(".confirm__close");
            const btnOk = template.content.querySelector(".confrim__button--ok");
            const btnCancel = template.content.querySelector(".confrim__button--cancel");

            // add different actions on clicking different areas
            confirmEl.addEventListener('click', e => {
                if (e.target === confirmEl) {
                    options.oncancel();
                    this._close(confirmEl);
                }
            });
            btnOk.addEventListener('click', () => {
                options.onok();
                this._close(confirmEl);
            });

            [btnCancel, btnClose].forEach(element => {
                element.addEventListener('click', e=>{
                    options.oncancel();
                    this._close(confirmEl);
                })
            });

            document.body.appendChild(template.content);
        },
        _close(confirmEl) {
            confirmEl.classList.add('confirm--close');

            confirmEl.addEventListener('animationend', () => {
                document.body.removeChild(confirmEl);
            })
        }
    };
    return Confirm;
}