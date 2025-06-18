{{-- resources/views/emails/property-inquiry.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Inquiry - {{ $property->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .email-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .property-showcase {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .property-showcase h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .property-showcase .property-details {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .property-detail-item {
            background: rgba(255,255,255,0.2);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .email-body {
            padding: 30px 20px;
        }

        .contact-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }

        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .info-icon svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .property-info-section {
            background: #e8f4fd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .property-info-section h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .property-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .property-info-item {
            background: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .property-info-item strong {
            color: #2c3e50;
        }

        .message-section {
            margin-top: 25px;
        }

        .message-header {
            background: #3498db;
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
        }

        .message-content {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e9ecef;
            border-top: none;
            font-size: 15px;
            line-height: 1.7;
        }

        .email-footer {
            background: #2c3e50;
            color: #bdc3c7;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }

        .timestamp {
            background: #e3f2fd;
            color: #1976d2;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .price-highlight {
            background: #27ae60;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 16px;
        }

        .status-badge {
            background: #27ae60;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
            margin-left: 10px;
        }

        .featured-badge {
            background: #f39c12;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .new-badge {
            background: #e74c3c;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 5px;
            }

            .email-header, .email-body {
                padding: 20px 15px;
            }

            .property-showcase .property-details {
                flex-direction: column;
                gap: 10px;
            }

            .property-info-grid {
                grid-template-columns: 1fr;
            }

            .info-row {
                flex-direction: column;
                text-align: center;
            }

            .info-icon {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🏠 Property Inquiry</h1>
            <p>{{ env('APP_NAME', 'Manufactured Movable Homes') }}</p>
        </div>

        <div class="property-showcase">
            <h2>{{ $property->title }}</h2>
            <div class="price-highlight">${{ number_format($property->price, 2) }}</div>
            <div class="property-details">
                <div class="property-detail-item">📍 {{ $property->city ?? 'Location' }}</div>
                <div class="property-detail-item">🛏️ {{ $property->bedrooms }} Bedrooms</div>
                <div class="property-detail-item">🚿 {{ $property->bathrooms }} Bathrooms</div>
                <div class="property-detail-item">📐 {{ number_format($property->area) }} sq ft</div>
                <div class="property-detail-item">🏠 {{ $property->property_type }}</div>
                @if($property->building_type)
                    <div class="property-detail-item">🏗️ {{ $property->building_type }}</div>
                @endif
            </div>
            <div style="margin-top: 15px;">
                @if($property->is_featured)
                    <span class="featured-badge">⭐ Featured</span>
                @endif
                @if($property->is_new)
                    <span class="new-badge">🆕 New</span>
                @endif
                <span class="status-badge">{{ $property->status }}</span>
            </div>
        </div>

        <div class="email-body">
            <div class="timestamp">
                📅 Inquiry received on {{ now()->format('F j, Y \a\t g:i A') }}
            </div>

            <div class="contact-info">
                <h3 style="margin-bottom: 20px; color: #2c3e50;">👤 Contact Information</h3>

                <div class="info-row">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $inquiry->name ?? 'Not provided' }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $inquiry->email ?? 'Not provided' }}</div>
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">{{ $inquiry->phone ?? 'Not provided' }}</div>
                    </div>
                </div>
            </div>

            <div class="property-info-section">
                <h3>🏠 Property Details</h3>
                <div class="property-info-grid">
                    <div class="property-info-item">
                        <strong>Address:</strong><br>{{ $property->address }}
                    </div>
                    <div class="property-info-item">
                        <strong>Property Type:</strong><br>{{ $property->property_type }}
                    </div>
                    <div class="property-info-item">
                        <strong>Price:</strong><br>${{ number_format($property->price, 2) }}
                    </div>
                    <div class="property-info-item">
                        <strong>Area:</strong><br>{{ number_format($property->area) }} sq ft
                    </div>
                    @if($property->building_type)
                    <div class="property-info-item">
                        <strong>Building Type:</strong><br>{{ $property->building_type }}
                    </div>
                    @endif
                    <div class="property-info-item">
                        <strong>Status:</strong><br>{{ $property->status }}
                    </div>
                </div>

                <div style="margin-top: 15px; padding: 15px; background: white; border-radius: 5px;">
                    <strong>Description:</strong><br>
                    <p style="margin-top: 8px; line-height: 1.6;">{{ $property->description }}</p>
                </div>
            </div>

            @if(isset($inquiry->message) && $inquiry->message)
            <div class="message-section">
                <div class="message-header">
                    💬 Customer Message
                </div>
                <div class="message-content">
                    {{ $inquiry->message }}
                </div>
            </div>
            @endif

            <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; padding: 20px; margin-top: 25px;">
                <h4 style="color: #856404; margin-bottom: 10px;">⏰ Next Steps</h4>
                <p style="color: #856404; margin: 0;">
                    Please respond to this inquiry promptly. The customer is interested in learning more about this property and may be ready to schedule a viewing or make an offer.
                </p>
            </div>
        </div>

        <div class="email-footer">
            <p>This email was automatically generated by {{ env('APP_NAME', 'Property Management System') }}</p>
            <p style="margin-top: 5px;">{{ now()->format('Y') }} © All rights reserved</p>
        </div>
    </div>
</body>
</html>
