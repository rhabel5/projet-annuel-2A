<!DOCTYPE html>
<html>
    <form method="POST" action="{{ route('simulation.store') }}">
        @csrf
        <div class="form-group">
            <label for="property_type">Type de propriété:</label>
            <select id="property_type" name="property_type" class="form-control">
                <option value="apartment">Appartement</option>
                <option value="house">Maison</option>
                <option value="studio">Studio</option>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Localisation:</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="income_estimate">Estimation des revenus:</label>
            <input type="number" id="income_estimate" name="income_estimate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</html>