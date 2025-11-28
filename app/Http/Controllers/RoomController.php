<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function store(StoreRoomRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('rooms', $filename, 'public');
            $data['image'] = $path;
        }

        $room = Room::create($data);

        return new RoomResource($room);
    }

    public function index()
    {
        $rooms = Room::where("status", 1)->orderBy("created_at", "desc")->get();
        return RoomResource::collection($rooms);
    }


    public function show(Room $room)
    {
        return new RoomResource($room);
    }

    public function update(Request $request, Room $room)
    {
        $data = [
            "room_number" => "required|integer",
            "floor" => "required|integer",
            "beds" => "required|integer",
            "price_per_hour" => "required|numeric",
            "status" => "required|boolean",
        ];

        if ($request->hasFile("image")) {
            $data["image"] = "image|mimes:jpg,jpeg,png,gif,webp|max:2048";
        }

        $validated = $request->validate($data);

        $room->update($validated);

        if ($request->hasFile("image")) {
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }
            $path = $request->file("image")->store("rooms", "public");
            $room->image = $path;
            $room->save();
        }

        return response()->json([
            "success" => true,
            "message" => "Room updated successfully",
            "data" => $room,
        ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(['message' => 'Room deleted']);
    }
}
