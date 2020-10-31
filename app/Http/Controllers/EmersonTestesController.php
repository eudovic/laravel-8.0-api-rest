<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EmersonTestesCreateRequest;
use App\Http\Requests\EmersonTestesUpdateRequest;
use App\Repositories\EmersonTestesRepository;
use App\Validators\EmersonTestesValidator;

/**
 * Class EmersonTestesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EmersonTestesController extends Controller
{
    /**
     * @var EmersonTestesRepository
     */
    protected $repository;

    /**
     * @var EmersonTestesValidator
     */
    protected $validator;

    /**
     * EmersonTestesController constructor.
     *
     * @param EmersonTestesRepository $repository
     * @param EmersonTestesValidator $validator
     */
    public function __construct(EmersonTestesRepository $repository, EmersonTestesValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $emersonTestes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $emersonTestes,
            ]);
        }

        return view('emersonTestes.index', compact('emersonTestes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmersonTestesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EmersonTestesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $emersonTestis = $this->repository->create($request->all());

            $response = [
                'message' => 'EmersonTestes created.',
                'data'    => $emersonTestis->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emersonTestis = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $emersonTestis,
            ]);
        }

        return view('emersonTestes.show', compact('emersonTestis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emersonTestis = $this->repository->find($id);

        return view('emersonTestes.edit', compact('emersonTestis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmersonTestesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EmersonTestesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $emersonTestis = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EmersonTestes updated.',
                'data'    => $emersonTestis->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'EmersonTestes deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EmersonTestes deleted.');
    }
}
