export type BackendFile = {
    id: string;
    title: string;
    file: string;
};

export type SelectItem = {
    id: string;
    title: string;
};

export type Event = {
    id: number;
    title: string;
    date: string;
    description: string;
    location: string;
    images: Array<string>;
};
