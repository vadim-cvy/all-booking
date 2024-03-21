(() =>
{
  const filterIdDataPropName = 'data-jab-filter-id'

  document.querySelectorAll(`[${filterIdDataPropName}]`).forEach( element =>
  {
    const filterId = element.getAttribute( filterIdDataPropName )

    const app = Vue.createApp({
      data: () => ({
        startTime: Date.now(),
        // todo: endTime

        results: [],
        isLoadingResults: true,

        areAdvancedControlsVisible: false,
      }),

      computed: {
        filterId()
        {
          return filterId
        },
      },

      methods: {
        generateUniqueId()
        {
          return '' + Math.floor( Date.now() / 1000 ) + Math.floor( Math.random() * 100000 )
        },

        async updateResults()
        {
          this.isLoadingResults = true
          // todo

          this.results = [
            {
              id: 1,
              title: 'Result 1',
              excerpt: 'Excerpt 1',
              img: {
                src: 'https://via.placeholder.com/150',
                alt: 'Placeholder',
              },
              status: {
                slug: 'available',
                label: 'Available',
              },
            },
            {
              id: 2,
              title: 'Result 2',
              excerpt: 'Excerpt 2',
              img: {
                src: 'https://via.placeholder.com/150',
                alt: 'Placeholder',
              },
              status: {
                slug: 'unavailable',
                label: 'Unavailable',
              },
            },
            {
              id: 3,
              title: 'Result 3',
              excerpt: 'Excerpt 3',
              img: {
                src: 'https://via.placeholder.com/150',
                alt: 'Placeholder',
              },
              status: {
                slug: 'unavailable',
                label: 'Unavailable',
              },
            },
            {
              id: 4,
              title: 'Result 4',
              excerpt: 'Excerpt 4',
              img: {
                src: 'https://via.placeholder.com/150',
                alt: 'Placeholder',
              },
              status: {
                slug: 'unavailable',
                label: 'Unavailable',
              },
            },
          ]

          this.isLoadingResults = false
        },
      },

      created()
      {
        this.updateResults()
      },
    })

    app.mount( element )
  });
})()