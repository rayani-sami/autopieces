<?php $__env->startSection('title', 'Assistant Virtuel'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="chatbot-container">
        <div class="text-center mb-4">
            <div class="bh-logo-circle mx-auto mb-3" style="width:60px;height:60px;background:var(--bh-gold)">
                <i class="fa fa-robot text-white" style="font-size:24px"></i>
            </div>
            <h4 class="fw-bold">Assistant Virtuel BH Bank</h4>
            <p class="text-muted small">Disponible 24h/24 — Posez vos questions sur nos services</p>
        </div>

        <!-- Chat window -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header py-3 d-flex align-items-center gap-2" style="background:var(--bh-navy)">
                <div class="bh-avatar-sm" style="background:var(--bh-gold)">
                    <i class="fa fa-robot text-white" style="font-size:14px"></i>
                </div>
                <div class="text-white">
                    <div class="fw-semibold small">BH Assistant</div>
                    <div style="font-size:11px;color:rgba(255,255,255,.6)">
                        <span class="me-1" style="color:#4ade80">●</span>En ligne
                    </div>
                </div>
            </div>
            <div class="chat-messages" id="chatMessages">
                <!-- Welcome message -->
                <div class="d-flex align-items-end gap-2 mb-3">
                    <div class="bh-avatar-sm" style="background:var(--bh-gold);flex-shrink:0">
                        <i class="fa fa-robot text-white" style="font-size:12px"></i>
                    </div>
                    <div class="chat-bubble bot">
                        Bonjour ! 👋 Je suis votre assistant virtuel BH Bank.<br>
                        Je peux vous renseigner sur :<br>
                        <ul class="mb-0 mt-1" style="font-size:13px">
                            <li>Nos <strong>crédits</strong> (immobilier, auto, consommation)</li>
                            <li>Nos offres d'<strong>épargne</strong> et placement</li>
                            <li>Nos <strong>agences</strong> et horaires</li>
                            <li>La prise de <strong>rendez-vous</strong></li>
                        </ul>
                        <div class="mt-2">Comment puis-je vous aider ?</div>
                    </div>
                </div>
            </div>

            <!-- Suggestions -->
            <div class="px-3 py-2 border-top bg-light" id="suggestions">
                <div class="small text-muted mb-2">Questions fréquentes :</div>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill suggestion-btn" data-msg="Quels types de crédits proposez-vous ?">Crédits disponibles</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill suggestion-btn" data-msg="Comment prendre un rendez-vous ?">Prendre un RDV</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill suggestion-btn" data-msg="Quels sont les horaires des agences ?">Horaires agences</button>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill suggestion-btn" data-msg="Comment ouvrir un compte ?">Ouvrir un compte</button>
                </div>
            </div>

            <!-- Input -->
            <div class="card-footer bg-white p-3">
                <div class="input-group">
                    <input type="text" id="userInput" class="form-control rounded-start-pill"
                        placeholder="Tapez votre message..." maxlength="500">
                    <button class="btn btn-bh-primary rounded-end-pill px-3" id="sendBtn">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
const chatMessages = document.getElementById('chatMessages');
const userInput    = document.getElementById('userInput');
const sendBtn      = document.getElementById('sendBtn');
const csrfToken    = document.querySelector('meta[name="csrf-token"]').content;

function scrollBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function appendUserMessage(text) {
    chatMessages.innerHTML += `
        <div class="d-flex justify-content-end mb-3">
            <div class="chat-bubble user">${escapeHtml(text)}</div>
        </div>`;
    scrollBottom();
}

function appendBotMessage(text) {
    chatMessages.innerHTML += `
        <div class="d-flex align-items-end gap-2 mb-3">
            <div class="bh-avatar-sm" style="background:var(--bh-gold);flex-shrink:0">
                <i class="fa fa-robot text-white" style="font-size:12px"></i>
            </div>
            <div class="chat-bubble bot">${text}</div>
        </div>`;
    scrollBottom();
}

function showTyping() {
    chatMessages.innerHTML += `
        <div id="typingIndicator" class="d-flex align-items-end gap-2 mb-3">
            <div class="bh-avatar-sm" style="background:var(--bh-gold);flex-shrink:0">
                <i class="fa fa-robot text-white" style="font-size:12px"></i>
            </div>
            <div class="chat-bubble bot py-3 px-3">
                <div class="typing-dots"><span></span><span></span><span></span></div>
            </div>
        </div>`;
    scrollBottom();
}

function removeTyping() {
    const el = document.getElementById('typingIndicator');
    if (el) el.remove();
}

function escapeHtml(text) {
    const d = document.createElement('div');
    d.appendChild(document.createTextNode(text));
    return d.innerHTML;
}

async function sendMessage(msg) {
    const message = (msg || userInput.value).trim();
    if (!message) return;

    userInput.value = '';
    document.getElementById('suggestions').style.display = 'none';
    appendUserMessage(message);
    showTyping();
    sendBtn.disabled = true;

    try {
        const res = await fetch('<?php echo e(route("chatbot.repondre")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ message })
        });
        const data = await res.json();
        removeTyping();
        appendBotMessage(data.reponse);
    } catch (e) {
        removeTyping();
        appendBotMessage("Désolé, une erreur est survenue. Veuillez réessayer.");
    } finally {
        sendBtn.disabled = false;
        userInput.focus();
    }
}

sendBtn.addEventListener('click', () => sendMessage());
userInput.addEventListener('keydown', e => { if (e.key === 'Enter') sendMessage(); });
document.querySelectorAll('.suggestion-btn').forEach(btn => {
    btn.addEventListener('click', () => sendMessage(btn.dataset.msg));
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\chahine\bhconnect\resources\views/visitor/chatbot.blade.php ENDPATH**/ ?>