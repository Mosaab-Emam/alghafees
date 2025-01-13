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

export type Post = {
    id: number;
    user_id: number;
    parent_id: number | null;
    password: string | null;
    status: "publish";
    post_type: "post";
    ordering: number;
    title: { ar: string; en?: string };
    slug: string;
    description: { ar: string; en?: string };
    featured_image: string | null;
    content: { ar: string; en?: string };
    created_at: string;
    updated_at: string;
    published_at: string;
    deleted_at: string;
};

export type Tag = {
    id: number;
    name: { ar: string };
    order_column: number;
    posts_published_count: number;
    slug: { ar: string };
    type: "tag";
    created_at: string;
    updated_at: string;
};

export type HomeStaticContent = {
    id: number;
    hero_small_top_title: string;
    hero_main_title: string;
    hero_image: string;
    description: string;
    hero_main_button_text: string;
    hero_main_button_link: string;
    hero_secondary_button_text: string;
    hero_secondary_button_link: string;
    hero_download_box_text: string;
    hero_x_link: string;
    hero_linkedin_link: string;
    hero_youtube_link: string;
    hero_vertical_text: string;
};
