<div class="accordion-item">
    <h2 class="accordion-header" id="headingDescription">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseDescription" aria-expanded="false" aria-controls="collapseDescription"
            style="font-size: 20px; font-weight: 500">
            Penjelasan Indikator
        </button>
    </h2>
    <div id="collapseDescription" class="accordion-collapse collapse" aria-labelledby="headingDescription">
        <div class="accordion-body" id="modalDescription">
            {{-- Isi modal di sini --}}
        </div>
    </div>
</div>
<div class="accordion-item">
    <h2 class="accordion-header" id="headingAssessment">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseAssessment" aria-expanded="false" aria-controls="collapseAssessment"
            style="font-size: 20px; font-weight: 500">
            Penjelasan Penilaian
        </button>
    </h2>
    <div id="collapseAssessment" class="accordion-collapse collapse" aria-labelledby="headingAssessment">
        <div class="accordion-body" id="modalAssessment">
            {{-- Isi modal di sini --}}
        </div>
    </div>
</div>
<div class="accordion-item">
    <h2 class="accordion-header" id="headingSupport">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSupport" aria-expanded="false" aria-controls="collapseSupport"
            style="font-size: 20px; font-weight: 500">
            Penjelasan Bukti Dukung
        </button>
    </h2>
    <div id="collapseSupport" class="accordion-collapse collapse" aria-labelledby="headingSupport">
        <div class="accordion-body" id="modalSupport">
            {{-- Isi modal di sini --}}
        </div>
    </div>
</div>
@for ($i = 1; $i <= 5; $i++)
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingLevel{{ $i }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseLevel{{ $i }}" aria-expanded="false"
                aria-controls="collapseLevel{{ $i }}" style="font-size: 20px; font-weight: 500">
                Level {{ $i }}
            </button>
        </h2>
        <div id="collapseLevel{{ $i }}" class="accordion-collapse collapse"
            aria-labelledby="headingLevel{{ $i }}">
            <div class="accordion-body" id="modalLevel{{ $i }}">
                {{-- Isi modal di sini --}}
            </div>
        </div>
    </div>
@endfor
