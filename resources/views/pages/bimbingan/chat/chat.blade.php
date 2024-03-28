@include('layouts.component.head')
@push('css')
    <style>
        ::-webkit-scrollbar {
            width: 10px
        }

        ::-webkit-scrollbar-track {
            background: #eee
        }

        ::-webkit-scrollbar-thumb {
            background: #888
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555
        }

        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main {
            background-color: #eee;
            width: 100%;
            position: relative;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }

        .scroll {
            overflow-y: auto;
            scroll-behavior: smooth;
            height: 400px
        }

        .name {
            font-size: 10px
        }

        .read {
            font-size: 10px
        }

        .msg {
            background-color: #fff;
            font-size: 14px;
            padding: 5px;
            border-radius: 5px;
            font-weight: 500;
            color: #3e3c3c
        }
    </style>
@endpush
<div class="">
    <div class="wrapper">
        <div class="main">

            <div class="px-2 scroll pt-3" id="message">
                <!-- Isi pesan akan ditampilkan di sini -->
            </div>
            <div class="bg-primary">
                <form id="form" class="d-flex navbar-expand-sm d-flex justify-content-between py-3 mx-2 flex-bottom">
                    <input type="text" name="text" class="form-control" placeholder="Tulis pesan disini...">
                    <button id="submitButton" class="btn btn-light py-2 mx-2">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                    <div id="loadingIcon" class="px-5" style="display: none; font-size: 24px; color: white;">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    {{-- Load pusher library --}}
    <script>
        function scrollToBottom() {
            var scrollElement = document.querySelector('.scroll');
            scrollElement.scrollTop = scrollElement.scrollHeight;
        }

        // Panggil scrollToBottom setelah dokumen selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });

        // Panggil scrollToBottom setiap kali konten diubah
        document.addEventListener('DOMSubtreeModified', function() {
            scrollToBottom();
        });
    </script>
    <script>
        const getChat = async (lastMessageTime) => {
            try {
                const response = await fetch(`/chat/get/{{ $room->id }}?last_message_time=${lastMessageTime}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch chat data');
                }
                const data = await response.json();

                let chatsHTML = '';

                data.forEach(r => {
                    const createdAt = new Date(r.created_at);
                    const timeString = createdAt.toLocaleTimeString('en-US', {
                        hour: 'numeric',
                        minute: 'numeric'
                    });

                    chatsHTML += `
                 <div class="d-flex align-items-center 
                 ${r.id_user == "{{ Auth::user()->id }}" ? 'text-right justify-content-end' : ''}">
                     <div class="pr-2 ${r.id_user == "{{ Auth::user()->id }}" ? '' : 'pl-1'}"> 
                         <span class="name">${r.id_user == "{{ Auth::user()->id }}" ? 'Anda' : "{{ Auth::user()->role == 'mahasiswa' ? 'Dosen' : 'Mahasiswa' }}" } | ${timeString}</span>
                         <p class="msg mb-0">${r.message}</p>
                         <span class="read ${r.is_read == 0 ? 'text-muted' :'text-success' } ">${r.is_read == 0 ? 'Belum di baca' :'<i class="fa fa-check"></i> dibaca' } </span>
                     </div>
                 </div>`;
                });

                document.getElementById('message').innerHTML = chatsHTML;
            } catch (error) {
                console.error('Error fetching chat:', error);
            }
        }

        window.addEventListener('load', async () => {
            Pusher.logToConsole = true;
            const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
            });

            // const channel = pusher.subscribe('chat-channel');
            const channel = pusher.subscribe('client-chat-channel');

            channel.bind('chat-send', async (data) => {
                const lastMessageTime = data.created_at;
                await getChat(lastMessageTime);
            });

            await getChat('');

            document.getElementById('form').addEventListener('submit', async (ev) => {
                ev.preventDefault();

                const submitButton = document.getElementById('submitButton');
                const loadingIcon = document.getElementById('loadingIcon');
                const message = document.querySelector('input[name="text"]');

                if (message.value.trim() !== '') {
                    submitButton.style.display = 'none';
                    loadingIcon.style.display = 'block';

                    try {
                        const response = await fetch('/chat/send', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: message.value,
                                room: '{{ $room->id }}'
                            })
                        });

                        const data = await response.json();

                        if (data) {
                            channel.trigger('client-chat-channel', 'chat-send', data);
                            await getChat('');

                            submitButton.style.display = 'block';
                            loadingIcon.style.display = 'none';

                            message.value = '';
                        }
                    } catch (error) {
                        console.error('Error sending chat:', error);
                    }
                }
            });
        });
    </script>
@endpush
@include('layouts.component.script')
