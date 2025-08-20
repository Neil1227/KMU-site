<!-- Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title highlight" id="downloadModalLabel">{{ $technology->product ?? 'Technology Details' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body (Image + Download Button) -->
      <div class="modal-body">
        @php
            $posterPath = $technology->poster && file_exists(storage_path('app/public/technologies/' . $technology->poster))
                        ? asset('storage/technologies/' . $technology->poster)
                        : asset('assets/img/kmlogo.png');
        @endphp

        <img src="{{ $posterPath }}" 
             alt="{{ $technology->product ?? 'Technology' }}" 
             class="img-fluid mb-3" 
             style="max-width: 100%; border-radius: 10px;">
        
        <!-- Download Button -->
        <a href="{{ $posterPath }}" 
           download 
           class="btn profit-btn">
          Download Image
        </a>
      </div>
    </div>
  </div>
</div>
