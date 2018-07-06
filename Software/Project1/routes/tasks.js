exports.list = function(req, res, next){
  req.db.electricity.find().toArray(function(error, tasks){
    if (error) return next(error);
    res.render('index', {
      title: 'Smart-keeper',
      datas: tasks || []
    });
  });
};
