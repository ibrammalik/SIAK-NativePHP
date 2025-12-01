<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            👤 Informasi Penduduk & Wilayah
        </x-slot>

        @php
        $user = auth()->user();
        $penduduk = $user->penduduk ?? null;
        @endphp

        {{-- Wrapper --}}
        <div style="margin-top: 16px; font-size: 14px; line-height: 1.6;">

            {{-- Container dua kartu --}}
            <div style="display: flex; flex-wrap: wrap; gap: 24px;">

                {{-- Data Penduduk --}}
                <x-filament::card style="flex: 1 1 300px; min-width: 280px;">
                    <x-slot name="heading">Data Penduduk</x-slot>

                    @if ($penduduk)
                    <dl style="margin: 0;">
                        <div
                            style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            <dt style="font-weight: 600;">Nama Penduduk</dt>
                            <dd style="margin-left: 0;">{{ $penduduk->nama }}
                            </dd>
                        </div>
                        <div
                            style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            <dt style="font-weight: 600;">NIK</dt>
                            <dd style="margin-left: 0;">{{ $penduduk->nik }}
                            </dd>
                        </div>
                        <div
                            style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            <dt style="font-weight: 600;">Status Dalam Keluarga
                            </dt>
                            <dd style="margin-left: 0;">{{ $penduduk->shdk }}
                            </dd>
                        </div>
                        <div style="padding: 8px 0;">
                            <dt style="font-weight: 600;">Pekerjaan</dt>
                            <dd style="margin-left: 0;">{{ $penduduk->pekerjaan
                                ?? '-' }}</dd>
                        </div>
                    </dl>
                    @else
                    <p>Belum terhubung dengan data penduduk.</p>
                    @endif
                </x-filament::card>

                {{-- Data Wilayah & Role --}}
                <x-filament::card style="flex: 1 1 300px; min-width: 280px;">
                    <x-slot name="heading">Wilayah & Peran</x-slot>

                    <dl style="margin: 0;">
                        <div
                            style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            <dt style="font-weight: 600;">Peran (Role)</dt>
                            <dd style="margin-left: 0;">
                                <x-filament::badge
                                    :color="$user->role->getColor()">
                                    {{ $user->role->label() }}
                                </x-filament::badge>
                            </dd>
                        </div>

                        @if ($user->rw)
                        <div
                            style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                            <dt style="font-weight: 600;">RW</dt>
                            <dd style="margin-left: 0;">{{ $user->rw->nomor }}
                            </dd>
                        </div>
                        @endif

                        @if ($user->rt)
                        <div style="padding: 8px 0;">
                            <dt style="font-weight: 600;">RT</dt>
                            <dd style="margin-left: 0;">{{ $user->rt->nomor }}
                            </dd>
                        </div>
                        @endif
                    </dl>
                </x-filament::card>

            </div>
        </div>
    </x-filament::section>

    @foreach ($this->getRegisteredCustomProfileComponents() as $component)
    @unless(is_null($component))
    @livewire($component)
    @endunless
    @endforeach
</x-filament-panels::page>