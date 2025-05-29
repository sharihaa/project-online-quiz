function generateCertificate() {
    const name = document.getElementById('nameInput').value;
    if (!name) {
        alert("Please enter your name!");
        return;
    }

    const canvas = document.getElementById('certificateCanvas');
    const ctx = canvas.getContext('2d');

    // Clear canvas
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw border
    ctx.strokeStyle = '#2196f3';
    ctx.lineWidth = 10;
    ctx.strokeRect(20, 20, canvas.width - 40, canvas.height - 40);

    // Title
    ctx.fillStyle = '#d81b60';
    ctx.font = 'bold 40px Arial';
    ctx.textAlign = 'center';
    ctx.fillText('Certificate of Achievement', canvas.width / 2, 100);

    // Name
    ctx.fillStyle = '#333';
    ctx.font = '30px Arial';
    ctx.fillText(`Awarded to: ${name}`, canvas.width / 2, 250);

    // Description
    ctx.font = '20px Arial';
    ctx.fillText('For completing the Awesome Test!', canvas.width / 2, 350);

    // Load logo
    const logo = new Image();
    logo.src = 'https://via.placeholder.com/100?text=Logo';
    logo.onload = () => {
        ctx.drawImage(logo, 50, 50, 100, 100);
        
        // Load signature
        const signature = new Image();
        signature.src = 'https://via.placeholder.com/150x50?text=Signature';
        signature.onload = () => {
            ctx.drawImage(signature, canvas.width - 200, canvas.height - 100, 150, 50);
            
            // Generate unique ID and verification link
            const uniqueId = Math.random().toString(36).substring(2, 10);
            const verifyLink = `verify.php?id=${uniqueId}`;
            document.getElementById('verifyLink').innerHTML = 
                `Verify your certificate at: <a href="${verifyLink}">${verifyLink}</a>`;
            
            // Send data to PHP (simulated)
            saveCertificate(uniqueId, name);
        };
    };
}

function saveCertificate(id, name) {
    // In a real app, this would send data to PHP via AJAX
    console.log(`Certificate saved with ID: ${id}, Name: ${name}`);
}