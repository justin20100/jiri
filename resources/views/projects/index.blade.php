
<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="">--}}
{{--            {{ __('Projects') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <section class="projects">
        <div class="projects__contentContainer">
            <div class="projects__contentContainer__header">
                <h1 class="projects__contentContainer__header__title">{{__("Projets")}}</h1>
                <div class="projects__contentContainer__header__buttonsContainer">
                    <div class="projects__contentContainer__header__buttonsContainer__filterContainer">
                        <div class="projects__contentContainer__header__buttonsContainer__filterContainer__filter">
                            <x-input-label for="sort" :value="__('Trier par')" />
                            <select id="sort" name="sort" required autocomplete="sort" class="select">
                                <option value="">{{__('Date de création')}}</option>
                                <option value="">{{__('Titre')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="projects__contentContainer__header__buttonsContainer__buttonContainer">
                        <livewire:projects.project-create-dialog/>
                    </div>
                </div>
            </div>
            <div class="projects__contentContainer__tableContainer">
                <table class="projects__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                        <tr class="table__head__line">
                            <th class="table__head__line__cell">{{__("Titre")}}</th>
                            <th class="table__head__line__cell">{{__("Description")}}</th>
                            <th class="table__head__line__cell">{{__("Date de création")}}</th>
                            <th class="table__head__line__cell"></th>
                        </tr>
                    </thead>
                    <livewire:projects.project-list/>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
