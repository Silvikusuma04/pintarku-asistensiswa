<?php
function koneksiDatabase() {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database_name = "pintar";

    $koneksi = mysqli_connect($server, $username, $password, $database_name);

    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    return $koneksi;
}

// Fungsi untuk menjawab pertanyaan dari database
function jawabPertanyaan($pertanyaan) {
    $jawabanDefault = "Maaf, saya tidak tahu jawaban untuk pertanyaan itu.";

    // Membuat koneksi ke database
    $koneksi = koneksiDatabase();

    // Mengamankan input pertanyaan
    $pertanyaan = $koneksi->real_escape_string($pertanyaan);

    // Query ke database untuk mendapatkan jawaban
    $query = "SELECT jawaban FROM asisten_jawaban WHERE pertanyaan LIKE '%$pertanyaan%'";
    $result = $koneksi->query($query);

    if ($result && $result->num_rows > 0) {
        // Mengambil jawaban dari database
        $row = $result->fetch_assoc();
        $jawaban = $row['jawaban'];
        return $jawaban;
    } else {
        return $jawabanDefault;
    }
}

$pertanyaan = '';
$jawaban = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pertanyaan = strtolower($_POST['pertanyaan']);
    $jawaban = jawabPertanyaan($pertanyaan);

    // If the answer is the default one, provide the additional message
    if ($jawaban === "Maaf, saya tidak tahu jawaban untuk pertanyaan itu.") {
        $jawaban = "Maaf, pertanyaan Anda belum dapat kami jawab. Silakan hubungi asisten kami via WhatsApp: <a href='https://api.whatsapp.com/send?phone=19176942789' target='_blank'>Asisten WhatsApp</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asisten Belajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .chat-container {
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-header {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 1.2em;
        }

        .chat-log {
            height: 300px;
            overflow-y: auto;
            padding: 10px;
        }

        .user-message, .assistant-message {
            max-width: 80%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #3498db;
            color: white;
            align-self: flex-start;
        }

        .assistant-message {
            background-color: #f2f2f2;
            color: #333;
            align-self: flex-end;
        }

        .input-container {
            display: flex;
            padding: 10px;
        }

        input {
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 5px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">Asisten Belajar</div>
        <div class="chat-log">
            <?php if (!empty($jawaban)) : ?>
                <div class="user-message">
                    <strong>You:</strong> <?php echo $_POST['pertanyaan']; ?>
                </div>
                <div class="assistant-message">
                    <strong>Asisten:</strong> <?php echo $jawaban; ?>
                </div>
            <?php endif; ?>
        </div>
        <form method="post" action="" class="input-container">
            <input type="text" name="pertanyaan" placeholder="Ketik pertanyaan di sini" required autofocus>
            <button type="submit">Tanyakan</button>
        </form>
    </div>
</body>
</html>
