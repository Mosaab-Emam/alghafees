import { Post, Tag } from "@/types";
import BlogCategories from "../../blog/blogCategories/BlogCategories";

export default function BlogDetailsTopBox({
    post,
    tags,
}: {
    post: Post;
    tags: Array<Tag>;
}) {
    return (
        <div className="flex lg:flex-row flex-col lg:gap-0 gap-[49px] xl:mb-[136px] lg:mb-[80px] mb-[50px]">
            <div className="xl:w-[745px] lg:w-[570px] w-full md:h-[447px] h-[213.422px]">
                <img
                    className="w-full h-full object-cover rounded-tl-[100px]"
                    src={
                        post.featured_image
                            ? post.featured_image
                            : "/default-post-image.jpg"
                    }
                    alt={post.title.ar}
                    loading="lazy"
                />
            </div>

            <BlogCategories tags={tags} />
        </div>
    );
}
