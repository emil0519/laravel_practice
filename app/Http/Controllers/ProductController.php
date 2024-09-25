namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Local variable to store products
    private $products = [];

    // Returns all products
    public function index()
    {
        return response()->json($this->products); // Return the local products array as JSON
    }

    // Adds a new product
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // Add the new product to the local array
        $this->products[] = $validatedData;

        return response()->json($validatedData, 201); // Return the created product with a 201 status
    }

    // Deletes a product by index (assuming ID corresponds to array index)
    public function destroy($id)
    {
        // Check if the product exists at the given index
        if (isset($this->products[$id])) {
            unset($this->products[$id]); // Remove the product from the array
            return response()->noContent(); // Return 204 No Content
        }

        return response()->json(['error' => 'Product not found'], 404); // Return 404 if not found
    }
}
