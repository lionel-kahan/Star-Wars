<?php

namespace App\Http\Controllers\admin;

use App\Tag;
use App\Product;
use App\Category;
use App\Picture;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Products Management';
        $products = Product::orderby('published_at', 'desc')->paginate(10);
        return view('admin\product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Product add";
        $tags = Tag::lists('name', 'id');
        $categories = Category::lists('title', 'id');
        return view('admin\product.create', compact('title', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:100',
            'slug'         => 'max:100',
//            todo vérifier que les champs obligatoire tels que le price le sont bien
            'price'        => 'required|numeric',
            'abstract'     => 'max:1000',
            'content'      => 'max:1000',
            'published_at' => 'date_format:d/m/Y',
            'quantity'     => 'integer',
            'status'       => 'in:opened,closed',
            'thumbnail'    => 'image|max:10000' ,   //3 Méga octet
        ]);

//        todo que se passe t'il en cas d'echec d'insertion ?
        $product = Product::create($request->all());
        $product->tags()->attach($request->input('tags'));    //en plus court $product->tags()->attach($request->tags));

//        if (!is_null($request->file('image'))) {
//            $this->upload($request, $product);
//        }

        if (!is_null($request->file('thumbnail'))) {
            $img = $request->file('thumbnail');
            $ext = $img->getClientOriginalExtension();
            $uri = str_random(12) . '.' . $ext;
            $size = $img->getSize(); //il est nécessaire de récupérer la taille de l'image avant le déplacement sinon il est possible d'utiliser la fonction getClientsize

            //La méthode move suivante renvoie une exception en cas de problème de déplacement de fichier
            $img->move(env('UPLOAD_PATH', './upload'), $uri);

            Picture::create([
                'uri'        => $uri                  ,
                'size'       => $size                 ,
                'type'       => $ext                  ,
                'product_id' => $product->id          ,
            ]);
        }

        return view('admin/message', [
            'title'       => 'Creation of product' ,
            'message'     => 'Product created'     ,
            'typeMessage' => 'success'             ,
            'uri'         => 'admin/product'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Product update";
        $product =  Product::find($id);
        $tags = Tag::lists('name', 'id');
        $categories = Category::lists('title', 'id');
        return view('admin\product.edit', compact('title', 'product', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        validate à faire

        $product = Product::find($id);
        if(!empty($request->input('tags'))) {
//            $product->tags()->detach();
//            $product->tags()->attach($request->input('tags'));
            //la méthode suivante est équivalente aux 2 précédentes lignes
            $product->tags()->sync($request->input('tags'));
        }else{
            $product->tags()->detach();
        }

//        todo ajouter un champ title pour l'image
        $img = $request->file('thumbnail');
        if (!is_null($img)) {
            $ext = $img->getClientOriginalExtension();
            $uri = $img->getClientOriginalName();
            $size = $img->getSize();
            $img->move(env('UPLOAD_PATH', './upload'), $uri);

            if(!is_null($product->picture)) {
                Storage::delete($product->picture->uri);
                $product->picture->delete();
            }

            Picture::create([
                'product_id' => $product->id ,
                'uri'        => $uri         ,
                'size'       => $size        ,
                'type'       => $ext         ,
            ]);
        } elseif (!is_null($request->input('delImage'))) {
            if(!is_null($product->picture)) {
                Storage::delete($product->picture->uri);
                $product->picture->delete();
            }
        }

        $product->update($request->all());

        return view('admin/message', [
            'title'       => 'Change product'      ,
            'message'     => 'Product updated'     ,
            'typeMessage' => 'success'             ,
            'uri'         => 'admin/product'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = $product->picture;

        if(!is_null($picture)) {
            Storage::delete($picture->uri);
            $picture->delete();
        }
        $product->delete();

        Product::destroy($id); //supprime en cascade les Tags associés aux produits
//        Picture::find('')

        Session::flash('message', 'Product deleted');
        return back();
    }

    public function changeStatus($id) {
        $product = Product::find($id);
        $product->status = ($product->status == 'opened') ? 'closed' : 'opened';
        $product->save();

        return back();
//        todo afficher une fenetre de confirmation lorsque le produit est commandé
    }

}
