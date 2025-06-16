import { Position } from "./position";

export interface Activity {
    id: string;
    start: Date;
    end: Date;
    duration: number;
    distance: number;
    positions: Position[]
}
