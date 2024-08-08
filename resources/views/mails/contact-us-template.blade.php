<div style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <!-- Header -->
        <div style="background-color: #228BE6; color: #ffffff; padding: 20px; text-align: center;">
            <!-- Logo -->
            <svg viewBox="0 0 42 26" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg" width="60px" style="margin-bottom: 15px;">
                <path d="M4.736 25.192C4.032 25.192 3.31733 25.128 2.592 25C1.888 24.872 1.30133 24.7227 0.832 24.552V20.776C1.28 20.8187 1.74933 20.8613 2.24 20.904C2.73067 20.9253 3.2 20.936 3.648 20.936C4.20267 20.936 4.66133 20.8507 5.024 20.68C5.408 20.5093 5.68533 20.2533 5.856 19.912C6.048 19.5493 6.144 19.0693 6.144 18.472V1.32H10.88V19.176C10.88 20.52 10.6667 21.64 10.24 22.536C9.83467 23.432 9.17333 24.104 8.256 24.552C7.36 24.9787 6.18667 25.192 4.736 25.192ZM15.3375 5.288C14.8895 5.288 14.6655 5.07467 14.6655 4.648V1.512C14.6655 1.064 14.8895 0.839998 15.3375 0.839998H18.9855C19.1775 0.839998 19.3268 0.903999 19.4335 1.032C19.5402 1.16 19.5935 1.32 19.5935 1.512V4.648C19.5935 5.07467 19.3908 5.288 18.9855 5.288H15.3375ZM14.7615 25V7.816H19.4975V25H14.7615ZM23.1365 25V7.816H26.7845L27.8725 10.44C28.4912 9.65067 29.1845 8.97867 29.9525 8.424C30.7418 7.86933 31.6698 7.592 32.7365 7.592C32.9712 7.592 33.2058 7.60267 33.4405 7.624C33.6965 7.64533 33.9312 7.688 34.1445 7.752V12.616C33.8245 12.5733 33.4832 12.5413 33.1205 12.52C32.7792 12.4773 32.4485 12.456 32.1285 12.456C31.5098 12.456 30.9445 12.5307 30.4325 12.68C29.9418 12.808 29.4832 13.0107 29.0565 13.288C28.6512 13.544 28.2565 13.8853 27.8725 14.312V25H23.1365ZM37.2438 5.288C36.7958 5.288 36.5718 5.07467 36.5718 4.648V1.512C36.5718 1.064 36.7958 0.839998 37.2438 0.839998H40.8918C41.0838 0.839998 41.2331 0.903999 41.3398 1.032C41.4464 1.16 41.4998 1.32 41.4998 1.512V4.648C41.4998 5.07467 41.2971 5.288 40.8918 5.288H37.2438ZM36.6678 25V7.816H41.4038V25H36.6678Z"/>
            </svg>
            <h1 style="margin: 0; font-size: 22px; color: #FFFFFF; font-weight: 400">Nouvelle prise de contact</h1>
        </div>

        <!-- Body -->
        <div style="padding: 20px; line-height: 1.6;">
            <p>Bonjour,</p>
            <p>Vous avez reçu une nouvelle prise de contact de la part de <strong>{{ $userFirstname }} {{ $userLastname }}</strong>.</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $userEmail }}" style="color: #007BFF;">{{ $userEmail }}</a></p>
            <p><strong>Message:</strong></p>
            <div style="background-color: #E7F5FF; padding: 15px; border-radius: 5px; border-left: 4px solid #228BE6; margin-bottom: 20px;">
                <p style="margin: 0;">{{ $userMessage }}</p>
            </div>
            <p>Nous vous invitons à répondre à cet email dès que possible.</p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f1f1f1; color: #555555; padding: 20px; text-align: center; font-size: 12px;">
            <p style="margin: 0;">Cet email a été généré automatiquement par le système de prise de contact de la page Welcome.</p>
            <p style="margin: 0;">&copy; 2024 Jiri. Tous droits réservés.</p>
        </div>
    </div>
</div>
